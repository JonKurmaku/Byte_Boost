<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->timestamps();
        });

        DB::table('admins')->insert([
            'username' => 'byteboost@admin_1',
            'password' => bcrypt('bytedefender1'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        DB::table('admins')->insert([
            'username' => 'byteboost@admin_2',
            'password' => bcrypt('bitprotector2'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
