<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Course;
use App\Models\ServerLog;
use App\Models\Student;
use App\Models\Lecturer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CourseRenderTest extends TestCase
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

    /**
     * Test course show for existing course.
     *
     * @return void
     */
    public function testCourseShowExistingCourse()
    {
        $lecturer = $this->createLecturer();
        
        $student = $this->createStudent();

        Auth::guard('student')->login($student);
        $course = $this->createCourse($lecturer, 'OOP');

        View::shouldReceive('exists')->andReturn(true);
        View::shouldReceive('make')->andReturnSelf();
        View::shouldReceive('share')->andReturnSelf();
        View::shouldReceive('replaceNamespace')->andReturnSelf();

        $response = $this->get('/lectures/' . $course->slug);

        $response->assertStatus(200);

        $this->assertDatabaseHas('server_logs', [
            'username' => $student->username,
            'user_level' => 'Student',
            'request_description' => 'Courses Render',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test course show for non-existing course.
     *
     * @return void
     */
    public function testCourseShowNonExistingCourse()
    {
        $lecturer = $this->createLecturer();
        $student = $this->createStudent();
        Auth::guard('student')->login($student);
        $course = $this->createCourse($lecturer, 'Introduction to Computer Science');

        $response = $this->get('/lectures/' . $course->slug);

        View::shouldReceive('exists')->andReturn(false);
        View::shouldReceive('make')->andReturnSelf();
        View::shouldReceive('share')->andReturnSelf();
        View::shouldReceive('replaceNamespace')->andReturnSelf();

        $response->assertViewIs('lectures.404')
                 ->assertStatus(200);
    }

    /**
     * Test course show for unauthorized access.
     *
     * @return void
     */
    public function testCourseShowUnauthorized()
    {
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer, 'oop');
        $response = $this->get('/lectures/' . $course->slug);
        $response->assertStatus(500); 
    }


    /**
     * Test course show with invalid slug.
     *
     * @return void
     */
    public function testCourseShowInvalidSlug()
    {
        $student = $this->createStudent();
        Auth::guard('student')->login($student);

        $response = $this->get('/lectures/invalid-slug');

        $response->assertStatus(404); 
    }
}
