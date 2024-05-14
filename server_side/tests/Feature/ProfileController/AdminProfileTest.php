<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Lecturer;
use App\Models\Course;
use App\Models\ServerLog;
use Illuminate\Support\Facades\Auth;

class AdminProfileTest extends TestCase
{
    use RefreshDatabase;

    private function createAdmin() {
        return Admin::create([
            'username' => 'admin_username',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin_password'),
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

    /**
     * Test rendering user activity log.
     *
     * @return void
     */
    public function testRenderUserActivityLog()
    {
        $admin = $this->createAdmin();
        Auth::guard('admin')->login($admin);

        $response = $this->get('/admin/dashboard/activity');

        $response->assertStatus(200)
                 ->assertViewIs('Dashboards.Admin.AdminLogs.userActivityLog');

        $this->assertDatabaseHas('server_logs', [
            'username' => $admin->username,
            'user_level' => 'Admin',
            'request_description' => 'Render User Activity Log',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test rendering server log.
     *
     * @return void
     */
    public function testRenderServerLog()
    {
        $admin = $this->createAdmin();
        Auth::guard('admin')->login($admin);

        $response = $this->get('/admin/dashboard/server-logs');

        $response->assertStatus(200)
                 ->assertViewIs('\Dashboards\Admin\AdminLogs\serverLog');

        $this->assertDatabaseHas('server_logs', [
            'username' => $admin->username,
            'user_level' => 'Admin',
            'request_description' => 'Render Server Log',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test rendering dashboard data.
     *
     * @return void
     */
    public function testRenderDashboardData()
    {
        $admin = $this->createAdmin();
        Auth::guard('admin')->login($admin);

        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200)
                 ->assertViewIs('Dashboards.Admin.dashboardAdmin');

        $this->assertDatabaseHas('server_logs', [
            'username' => $admin->username,
            'user_level' => 'Admin',
            'request_description' => 'Render Dashboard List',
            'http_request_type' => 'GET'
        ]);
    }

    /**
     * Test deleting a student.
     *
     * @return void
     */
    public function testDeleteStudent()
    {
        $admin = $this->createAdmin();
        Auth::guard('admin')->login($admin);
        $student = $this->createStudent();

        $response = $this->delete('/admin/dashboard/delete-std/' . $student->id);

        $response->assertStatus(302); 
        $this->assertDatabaseMissing('students', ['id' => $student->id]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $admin->username,
            'user_level' => 'Admin',
            'request_description' => 'Delete Student',
            'http_request_type' => 'DELETE'
        ]);
    }

    /**
     * Test deleting a lecturer.
     *
     * @return void
     */
    public function testDeleteLecturer()
    {
        $admin = $this->createAdmin();
        Auth::guard('admin')->login($admin);
        $lecturer = $this->createLecturer();

        $response = $this->delete('/admin/dashboard/delete-lect/' . $lecturer->id);

        $response->assertStatus(302); 
        $this->assertDatabaseMissing('lecturers', ['id' => $lecturer->id]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $admin->username,
            'user_level' => 'Admin',
            'request_description' => 'Delete Lecturer',
            'http_request_type' => 'DELETE'
        ]);
    }

    /**
     * Test deleting a course.
     *
     * @return void
     */
    public function testDeleteCourse()
    {
        $admin = $this->createAdmin();
        Auth::guard('admin')->login($admin);
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);

        $response = $this->delete('/admin/dashboard/delete-course/' . $course->id);

        $response->assertStatus(302); 
        $this->assertDatabaseMissing('courses', ['id' => $course->id]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $admin->username,
            'user_level' => 'Admin',
            'request_description' => 'Delete Course',
            'http_request_type' => 'DELETE'
        ]);
    }

    /**
     * Test updating a student.
     *
     * @return void
     */
    public function testUpdateStudent()
    {
        $admin = $this->createAdmin();
        Auth::guard('admin')->login($admin);
        $student = $this->createStudent();

        $response = $this->putJson('/admin/dashboard/edit-std', [
            'studentID' => $student->id,
            'studentFirstname' => 'NewFirstName',
            'studentLastname' => 'NewLastName',
            'studentEmail' => 'newstudent@example.com',
            'studentProgram' => 'BSc Mathematics'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Profile updated successfully']);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'first_name' => 'NewFirstName',
            'last_name' => 'NewLastName',
            'email' => 'newstudent@example.com',
            'program' => 'BSc Mathematics'
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $admin->username,
            'user_level' => 'Admin',
            'request_description' => 'Update Student Credentials',
            'http_request_type' => 'PUT'
        ]);
    }

    /**
     * Test updating a lecturer.
     *
     * @return void
     */
    public function testUpdateLecturer()
    {
        $admin = $this->createAdmin();
        Auth::guard('admin')->login($admin);
        $lecturer = $this->createLecturer();

        $response = $this->putJson('/admin/dashboard/edit-lect', [
            'lecturerID' => $lecturer->id,
            'lecturerFirstname' => 'NewFirstName',
            'lecturerLastname' => 'NewLastName',
            'lecturerEmail' => 'newlecturer@example.com',
            'lecturerDepartment' => 'Mathematics',
            'lecturerSpecialization' => 'Algebra'
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Profile updated successfully']);

        $this->assertDatabaseHas('lecturers', [
            'id' => $lecturer->id,
            'first_name' => 'NewFirstName',
            'last_name' => 'NewLastName',
            'email' => 'newlecturer@example.com',
            'department' => 'Mathematics',
            'specialization' => 'Algebra'
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $admin->username,
            'user_level' => 'Admin',
            'request_description' => 'Update Lecturer Credentials',
            'http_request_type' => 'PUT'
        ]);
    }

    /**
     * Test updating a course.
     *
     * @return void
     */
    public function testUpdateCourse()
    {
        $admin = $this->createAdmin();
        Auth::guard('admin')->login($admin);
        $lecturer = $this->createLecturer();
        $course = $this->createCourse($lecturer);

        $response = $this->putJson('/admin/dashboard/edit-course', [
            'courseID' => $course->id,
            'courseName' => 'Advanced Computer Science',
            'courseMaxnumber' => 50
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Profile updated successfully']);

        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'course_name' => 'Advanced Computer Science',
            'max_students' => 50
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $admin->username,
            'user_level' => 'Admin',
            'request_description' => 'Update Courses Credentials',
            'http_request_type' => 'PUT'
        ]);
    }
}
