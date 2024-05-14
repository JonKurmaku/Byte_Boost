<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\Lecturer;
use App\Models\ServerLog;

class LecturerSignUpTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * Test lecturer creation.
     *
     * @return void
     */
    public function testLecturerCreation()
    {
        $this->withoutMiddleware();

        $requestData = [
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'department' => $this->faker->word,
            'specialization' => $this->faker->optional()->word,
            'experience' => $this->faker->optional()->randomNumber()
        ];

        $response = $this->post('/lecturers', $requestData);

        $response->assertStatus(302);
        $response->assertRedirect('/lecturer/login');

        $this->assertDatabaseHas('lecturers', [
            'username' => $requestData['username'],
            'email' => $requestData['email'],
            'first_name' => $requestData['first_name'],
            'last_name' => $requestData['last_name'],
            'department' => $requestData['department'],
            'specialization' => $requestData['specialization'],
            'experience' => $requestData['experience']
        ]);

        $this->assertDatabaseHas('server_logs', [
            'username' => $requestData['username'],
            'user_level' => 'Lecturer',
            'request_description' => 'Create Profile',
            'http_request_type' => 'POST'
        ]);
    }
}
