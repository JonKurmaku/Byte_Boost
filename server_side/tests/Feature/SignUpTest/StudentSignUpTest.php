<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Student;
use App\Models\ServerLog;

class StudentSignUpTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test student creation.
     *
     * @return void
     */
    public function testStudentCreation()
    {
        $this->withoutMiddleware();

        $requestData = [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'program' => $this->faker->word,
            'gender' => $this->faker->optional()->randomElement(['male', 'female', 'other']),
            'dob' => $this->faker->date,
            'country' => $this->faker->optional()->country,
            'interests' => $this->faker->optional()->sentence
        ];

        $response = $this->post('/students', $requestData);

        $response->assertStatus(302);
        $response->assertRedirect('/student/login');

        $this->assertDatabaseHas('students', [
            'username' => $requestData['username'],
            'email' => $requestData['email'],
            'first_name' => $requestData['first_name'],
            'last_name' => $requestData['last_name'],
            'program' => $requestData['program'],
            'gender' => $requestData['gender'],
            'dob' => $requestData['dob'],
            'country' => $requestData['country'],
            'interests' => $requestData['interests']
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $requestData['username'],
            'user_level' => 'Student',
            'request_description' => 'Create Profile',
            'http_request_type' => 'POST'
        ]);
    }
}
