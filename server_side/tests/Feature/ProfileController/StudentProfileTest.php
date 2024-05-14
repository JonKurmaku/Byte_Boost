<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;
use App\Models\Course;
use App\Models\Lecturer;
use App\Models\ServerLog;
use App\Models\Feedbacks;
use App\Models\FinalAssessment;
use App\Models\MentorshipApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentProfileTest extends TestCase
{
    use RefreshDatabase;

    private function createStudent() {
        return Student::create([
            'username' => 'student_username',
            'email' => 'student@example.com',
            'password' => Hash::make('student_password'),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'program' => 'BSc CS',
            'dob' => '2000-01-01'
        ]);
    }

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
            'num_students_chosen' => 1,
            'max_students' => 30
        ]);
    }

    /**
     * Test updating a student's profile.
     *
     * @return void
     */
    public function testUpdateStudentProfile()
{
    $student = $this->createStudent();
    Auth::guard('student')->login($student);
    $studentold = $student->username;
    $response = $this->putJson('/student/dashboard', [
        'n_username' => 'new_username',
        'n_password' => 'new_password'
    ]);

    $response->assertStatus(200)
             ->assertJson(['message' => 'Profile updated successfully']);

    $this->assertDatabaseHas('students', [
        'id' => $student->id,
        'username' => 'new_username',
    ]);

    $updatedStudent = Student::find($student->id);

    $this->assertTrue(Hash::check('new_password', $updatedStudent->password));

    $this->assertDatabaseHas('server_logs', [
        'username' => $studentold,
        'user_level' => 'Student',
        'request_description' => 'Update Profile Credentials',
        'http_request_type' => 'PUT'
    ]);
}

    /**
     * Test showing available courses.
     *
     * @return void
     */
    public function testShowAvailableCourses()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);

        Auth::guard('student')->login($student);

        $response = $this->get('/student/dashboard/courseSelection');

        $response->assertStatus(200)
                 ->assertViewIs('Dashboards\Student\CourseSelection\courseSelection');

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Render Course Selection Page',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test rendering the dashboard with courses.
     *
     * @return void
     */
    public function testRenderDashboardWithCourses()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student->courses()->attach($course->id);

        Auth::guard('student')->login($student);

        $response = $this->get('/student/dashboard');

        $response->assertStatus(200)
                 ->assertViewIs('Dashboards\Student\dashboardStd');

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Render Dashboard Courses',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test rendering grades.
     *
     * @return void
     */
    public function testRenderGrades()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student->courses()->attach($course->id);

        FinalAssessment::create([
            'student_id' => $student->id,
            'course_id' => $course->id,
            'grade' => 'A',
            'answer_1' => 'Answer 1',
            'answer_2' => 'Answer 2',
            'answer_3' => 'Answer 3',
            'answer_4' => 'Answer 4',
            'answer_5' => 'Answer 5',
        ]);

        Auth::guard('student')->login($student);

        $response = $this->get('/student/dashboard/grades');

        $response->assertStatus(200)
                 ->assertViewIs('Dashboards\Student\Grades\grades');

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Render Grades',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test adding a course.
     *
     * @return void
     */
    public function testAddCourse()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);

        Auth::guard('student')->login($student);

        $response = $this->post('/student/course/add', [
            'course_id' => $course->id,
        ]);

        $response->assertStatus(302); 

        $this->assertDatabaseHas('student_course', [
            'course_id' => $course->id,
            'student_id' => $student->id
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Add Course',
            'http_request_type' => 'POST'
        ]);
    }

    /**
     * Test removing a course.
     *
     * @return void
     */
    public function testRemoveCourse()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student->courses()->attach($course->id);

        Auth::guard('student')->login($student);

        $response = $this->delete('/student/course/remove/' . $course->id);

        $response->assertStatus(302); 

        $this->assertDatabaseMissing('student_course', [
            'course_id' => $course->id,
            'student_id' => $student->id,
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Remove Course',
            'http_request_type' => 'DELETE'
        ]);
    }

    /**
     * Test fetching all lecturers.
     *
     * @return void
     */
    public function testFetchLecturers()
    {
        $lecturer = $this->createLecturer();

        $response = $this->getJson('/student/dashboard/feedback-lecturers');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $lecturer->id,
                     'first_name' => 'Lecturer_FirstName',
                     'last_name' => 'Lecturer_LastName'
                 ]);
    }

    /**
     * Test fetching courses of a lecturer.
     *
     * @return void
     */
    public function testFetchLecturerCourses()
    {
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);

        $response = $this->getJson('/student/dashboard/feedback-courses/' . $lecturer->id );

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $course->id,
                     'course_name' => 'Introduction to Computer Science'
                 ]);
    }

    /**
     * Test giving feedback for a course.
     *
     * @return void
     */
    public function testGiveFeedback()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student->courses()->attach($course->id);

        Auth::guard('student')->login($student);

        $response = $this->post('/student/dashboard/send-feedback', [
            'course_id' => $course->id,
            'comment' => 'Great course!',
            'rating' => 5
        ]);

        $response->assertStatus(200); 
        $this->assertDatabaseHas('feedbacks', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'comment' => 'Great course!',
            'rating' => 5
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Send Course Feedback',
            'http_request_type' => 'POST'
        ]);
    }

    /**
     * Test rendering mentorship courses.
     *
     * @return void
     */
    public function testRenderMentorshipCourses()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student->courses()->attach($course->id);

        Auth::guard('student')->login($student);

        $response = $this->get('/student/dashboard/mentorship');

        $response->assertStatus(200)
                 ->assertViewIs('Dashboards\Student\Mentorship\mentorshipProgram');

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Render Mentorship Courses',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test applying for mentorship.
     *
     * @return void
     */
    public function testApplyForMentorship()
    {
        $student = $this->createStudent();
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);
        $student->courses()->attach($course->id);

        Auth::guard('student')->login($student);

        $response = $this->postJson('/student/dashboard/mentorship-apply', [
            'course_id' => $course->id
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Mentorship application submitted successfully']);

        $this->assertDatabaseHas('mentorship_applications', [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'hasBeenAccepted' => false
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Apply for Mentorship program',
            'http_request_type' => 'POST'
        ]);
    }
}
