<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Student extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'program',
        'gender',
        'dob',
        'country',
        'interests',
    ];

    
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_course')->withTimestamps();
    }

    /**
     * Check if the student has already chosen a specific course.
     *
     * @param int $courseId The ID of the course to check.
     * @return bool True if the student has chosen the course, false otherwise.
     */
    public function hasChosenCourse($courseId)
    {
        return $this->courses->contains($courseId);
    }
}
