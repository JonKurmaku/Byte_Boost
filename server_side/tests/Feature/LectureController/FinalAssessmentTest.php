<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\FinalAssessment;
use App\Models\Course;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\ServerLog;
use Illuminate\Support\Facades\Auth;

class FinalAssessmentTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private function createLecturer() {
        return Lecturer::create([
            'username' => 'lecturer_username',
            'email' => 'lecturer@example.com',
            'password' => bcrypt('lecturer_password'),
            'first_name' => 'Lecturer_FirstName',
            'last_name' => 'Lecturer_LastName',
            'department' => 'Computer Science', 
            'specialization' => 'Software Engineering', 
            'experience' => 10 
        ]);
    }

    private function createStudent() {
        return Student::create([
            'username' => 'studentuser',
            'email' => 'student@example.com',
            'password' => bcrypt('password123'),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'program' => 'BSc CS',
            'dob' => '2000-01-01'
        ]);
    }

    private function createCourse($lecturer, $name) {
        return Course::create([
            'lecturer_id' => $lecturer->id,
            'course_id' => 'CEN101',
            'course_name' => $name,
            'slug' => '',
            'max_students' => 30
        ]);
    }

    private function createFinalAssessment($student, $course) {
        return FinalAssessment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'grade' => 'N/A',
            'answer_1' => 'Answer 1',
            'answer_2' => 'Answer 2',
            'answer_3' => 'Answer 3',
            'answer_4' => 'Answer 4',
            'answer_5' => 'Answer 5',
        ]);
    }

    /**
     * Test storing a final assessment.
     *
     * @return void
     */
    public function testStoreFinalAssessment()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer, 'OOP');

        Auth::guard('student')->login($student);

        $response = $this->postJson('/final-assessment/store', [
            'studentId' => $student->id,
            'courseId' => $course->id,
            'q1' => 'Answer 1',
            'q2' => 'Answer 2',
            'q3' => 'Answer 3',
            'q4' => 'Answer 4',
            'q5' => 'Answer 5',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'student_id',
                     'course_id',
                     'grade',
                     'answer_1',
                     'answer_2',
                     'answer_3',
                     'answer_4',
                     'answer_5',
                 ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Final Assessment POST',
            'http_request_type' => 'POST'
        ]);
    }

    /**
     * Test rendering the final assessment page.
     *
     * @return void
     */
    public function testRenderFinalAssessment()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer, 'OOP');

        Auth::guard('student')->login($student);

        $response = $this->get('/final-assessment/' . $course->slug .'/take');

        $response->assertStatus(200)
                 ->assertViewIs('FinalAssessment.' . $course->slug . '-final');

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Final Assessment Render',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test getting students with pending final assessments.
     *
     * @return void
     */
    public function testGetStudentsWithPendingFinalAssessments()
    {
        $lecturer = $this->createLecturer();
        $student = $this->createStudent();
        $course = $this->createCourse($lecturer, 'OOP');
        $this->createFinalAssessment($student, $course);

        Auth::guard('lecturer')->login($lecturer);

        $response = $this->getJson('/final-assessment/students/' . $course->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'students',
                     'finalAssessments',
                 ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $lecturer->username,
            'user_level' => 'Lecturer',
            'request_description' => 'Get Students with N/A Grade',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test evaluating a final assessment.
     *
     * @return void
     */
    public function testEvaluateFinalAssessment()
    {
        $lecturer = $this->createLecturer();
       
        $student = $this->createStudent();
        $course = $this->createCourse($lecturer, 'OOP');
        $finalAssessment = $this->createFinalAssessment($student, $course);

        Auth::guard('lecturer')->login($lecturer);

        $response = $this->postJson('/final-assesment/lecturer/evaluate', [
            'studentID' => $student->id,
            'selectedValue' => 'A',
            'courseID' => $course->id,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Evaluation submitted successfully'
                 ]);

        $this->assertDatabaseHas('final_assessments', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'grade' => 'A',
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $lecturer->username,
            'user_level' => 'Lecturer',
            'request_description' => 'Final Assessment Grading',
            'http_request_type' => 'POST'
        ]);
    }
}
