<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Student;
use App\Models\Course;
use App\Models\Lecturer; 

class StudentCourseTest extends TestCase
{
    use RefreshDatabase;

    public function testCourseEnrollment()
    {
       $lecturer = Lecturer::create([
            'username' => 'lecturer_username',
            'email' => 'lecturer@example.com',
            'password' => bcrypt('lecturer_password'),
            'first_name' => 'Lecturer_FirstName',
            'last_name' => 'Lecturer_LastName',
            'department' => 'Computer Science', 
            'specialization' => 'Software Engineering', 
            'experience' => 10 
        ]);
        
        $student = Student::create([
            'username' => 'studentuser',
            'email' => 'student@example.com',
            'password' => bcrypt('password123'),
            'first_name' => 'John',
            'last_name' => 'Doe',
            'program' => 'BSc CS',
            'dob' => '2000-01-01'
        ]);

        $course = Course::create([
            'lecturer_id'=>$lecturer->id,
            'course_id' => 'CS101',
            'course_name' => 'Intro to Computer Science',
            'slug' => 'intro-cs',
            'max_students' => 30
        ]);

        $student->courses()->attach($course->id);

        $this->assertDatabaseHas('student_course', [
            'student_id' => $student->id,
            'course_id' => $course->id
        ]);
    }
}
