<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('server_logs', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('user_level');
            $table->string('request_description');
            $table->string('http_request_type');
            $table->timestamp('request_time');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_logs');
    }
};
