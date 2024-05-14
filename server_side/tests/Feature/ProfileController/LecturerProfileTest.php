<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Lecturer;
use App\Models\Course;
use App\Models\ServerLog;
use App\Models\Feedbacks;
use App\Models\MentorshipApplication;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LecturerProfileTest extends TestCase
{
    use RefreshDatabase;

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

    private function createCourse($lecturer) {
        return Course::create([
            'lecturer_id' => $lecturer->id,
            'course_id' => 'CS101',
            'course_name' => 'Introduction to Computer Science',
            'slug' => 'intro-cs',
            'max_students' => 30
        ]);
    }

    private function createStudent() {
        return Student::create([
            'username' => 'student_username',
            'email' => 'student@example.com',
            'password' => bcrypt('student_password'),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'program' => 'BSc CS',
            'dob' => '2000-01-01'
        ]);
    }

    /**
     * Test updating a lecturer's profile.
     *
     * @return void
     */
    public function testUpdateLecturerProfile()
    {
        $lecturer = $this->createLecturer();
        Auth::guard('lecturer')->login($lecturer);
        $lecturerold = $lecturer->username;
        $response = $this->putJson('/lecturer/dashboard', [
            'n_username' => 'new_username',
            'n_password' => 'new_password'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Profile updated successfully']);

        $this->assertDatabaseHas('lecturers', [
            'id' => $lecturer->id,
            'username' => 'new_username',
        ]);

        $updatedLecturer = Lecturer::find($lecturer->id);

        $this->assertTrue(Hash::check('new_password', $updatedLecturer->password));

        $this->assertDatabaseHas('server_logs', [
            'username' => $lecturerold,
            'user_level' => 'Lecturer',
            'request_description' => 'Update Profile Credentials',
            'http_request_type' => 'PUT'
        ]);
    }

    /**
     * Test showing dashboard courses.
     *
     * @return void
     */
    public function testShowDashboardCourses()
    {
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);

        Auth::guard('lecturer')->login($lecturer);

        $response = $this->get('/lecturer/dashboard/courses');

        $response->assertStatus(200)
                 ->assertViewIs('\Dashboards\Lecturer\coursePage');

        $this->assertDatabaseHas('courses', [
            'lecturer_id' => $lecturer->id,
            'course_name' => 'Introduction to Computer Science'
        ]);
    }

    /**
     * Test adding a course.
     *
     * @return void
     */
    public function testAddCourse()
    {
        $lecturer = $this->createLecturer();
        Auth::guard('lecturer')->login($lecturer);

        $response = $this->postJson('/lecturer/dashboard/add-courses', [
            'course_id' => 'CS102',
            'course_name' => 'Advanced Computer Science',
            'max_students' => 40
        ]);

        $response->assertStatus(201)
                 ->assertJson(['message' => 'Course added successfully']);

        $this->assertDatabaseHas('courses', [
            'course_id' => 'CS102',
            'course_name' => 'Advanced Computer Science',
            'max_students' => 40
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $lecturer->username,
            'user_level' => 'Lecturer',
            'request_description' => 'Add Course',
            'http_request_type' => 'POST'
        ]);
    }

    /**
     * Test deleting a course.
     *
     * @return void
     */
    public function testDeleteCourse()
    {
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);

        Auth::guard('lecturer')->login($lecturer);

        $response = $this->delete('/lecturer/dashboard/courses/' . $course->course_id);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Course deleted successfully']);

        $this->assertDatabaseMissing('courses', [
            'course_id' => $course->course_id
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $lecturer->username,
            'user_level' => 'Lecturer',
            'request_description' => 'Delete Course',
            'http_request_type' => 'DELETE'
        ]);
    }

    /**
     * Test showing feedback.
     *
     * @return void
     */
    public function testShowFeedback()
    {
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student = $this->createStudent();

        Feedbacks::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'comment' => 'Great course!',
            'rating' => 5
        ]);

        Auth::guard('lecturer')->login($lecturer);

        $response = $this->get('/lecturer/feedback');

        $response->assertStatus(200)
                 ->assertViewIs('\Dashboards\Lecturer\feedbackPage')
                 ->assertViewHas('feedback');

        $this->assertDatabaseHas('feedbacks', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'comment' => 'Great course!',
            'rating' => 5
        ]);
    }

    /**
     * Test rendering evaluation page.
     *
     * @return void
     */
    public function testRenderEvaluationPage()
    {
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);

        Auth::guard('lecturer')->login($lecturer);

        $response = $this->get('/lecturer/dashboard/evaluation');

        $response->assertStatus(200)
                 ->assertViewIs('\Dashboards\Lecturer\evaluationPage')
                 ->assertViewHas('lecturerCourses');
    }

    /**
     * Test rendering mentorship overview.
     *
     * @return void
     */
    public function testRenderMentorshipOverview()
    {
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student = $this->createStudent();

        MentorshipApplication::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'hasBeenAccepted' => false,
            'hasBeenProcessed' => false
        ]);

        Auth::guard('lecturer')->login($lecturer);

        $response = $this->get('/lecturer/dashboard/mentorship');

        $response->assertStatus(200)
                 ->assertViewIs('Dashboards\Lecturer\mentorshipOverview')
                 ->assertViewHas('mentorshipApplications');
    }

    /**
     * Test processing mentorship application.
     *
     * @return void
     */
    public function testProcessMentorshipApplication()
    {
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student = $this->createStudent();

        MentorshipApplication::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'hasBeenAccepted' => false,
            'hasBeenProcessed' => false
        ]);

        Auth::guard('lecturer')->login($lecturer);

        $response = $this->postJson('/lecturer/dashboard/mentorship/process', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'status' => true
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Evaluation submitted successfully']);

        $this->assertDatabaseHas('mentorship_applications', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'hasBeenAccepted' => true,
            'hasBeenProcessed' => true
        ]);
    }

    /**
     * Test rendering student list.
     *
     * @return void
     */
    public function testRenderStudentList()
    {
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student = $this->createStudent();
        $student->courses()->attach($course->id);

        Auth::guard('lecturer')->login($lecturer);

        $response = $this->get('/lecturer/dashboard/studentlist');

        $response->assertStatus(200)
                 ->assertViewIs('Dashboards\Lecturer\studentList')
                 ->assertViewHas('studentCourseInfo');
    }
}
