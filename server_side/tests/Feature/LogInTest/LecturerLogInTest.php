<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Lecturer;

class LecturerLogInTest extends TestCase
{
    use RefreshDatabase;

    public function testLecturerLogin()
    {
        
        $lecturer=Lecturer::create([
            'username' => 'lectureruser',
            'email' => 'lecturer@example.com',
            'password' => bcrypt('password123'),
            'first_name' => 'Lecturer_FirstName',
            'last_name' => 'Lecturer_LastName',
            'department' => 'Computer Science', 
            'specialization' => 'Software Engineering', 
            'experience' => '10' 
        ]);

        $response = $this->post('/lecturer/login', [
            'username' => 'lectureruser',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/lecturer/dashboard');
        $this->assertAuthenticatedAs($lecturer, 'lecturer');
    }

    public function testLecturerLogout()
    {
        $response = $this->get('/lecturer/logout');

        $response->assertRedirect('/lecturer/login');
        $this->assertGuest('lecturer');
    }
}
