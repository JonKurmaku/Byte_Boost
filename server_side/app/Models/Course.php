<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    protected $fillable = [
        'lecturer_id',
        'course_id',
        'course_name',
        'num_students_chosen',
        'max_students',
        'slug', 
    ];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class, 'lecturer_id'); 
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_course')->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            $course->slug = Str::slug($course->course_name);
        });

        static::updating(function ($course) {
            $course->slug = Str::slug($course->course_name);
        });
    }
}
