<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique()->nullable(false);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('program');
            $table->string('gender')->nullable();
            $table->date('dob');
            $table->string('country')->nullable();
            $table->string('interests')->nullable();
            $table->timestamps();
        });

        Schema::create('student_course', function (Blueprint $table) {
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->primary(['student_id', 'course_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_course');
        Schema::dropIfExists('students');
    }
};
