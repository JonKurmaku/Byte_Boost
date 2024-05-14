<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;

class StudentLogInTest extends TestCase
{
    use RefreshDatabase;

    public function testStudentLogin()
    {
        $student = Student::create([
            'username' => 'studentuser',
            'email' => 'student@example.com',
            'password' => bcrypt('password123'),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'program' => 'BSc CS',
            'dob' => '2000-01-01'
        ]);


        $response = $this->post('/student/login', [
            'username' => 'studentuser',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/student/dashboard');
        $this->assertAuthenticatedAs($student, 'student');
    }

    public function testStudentLogout()
    {
        $response = $this->get('/student/logout');

        $response->assertRedirect('/student/login');
        $this->assertGuest('student');
    }
}
