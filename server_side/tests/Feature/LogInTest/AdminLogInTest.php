<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;

class AdminLogInTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminLogin()
    {
        $admin = Admin::create([
            'username' => 'adminuser',
            'password' => bcrypt('password123')
        ]);

        $response = $this->post('/admin/login', [
            'username' => 'adminuser',
            'password' => 'password123'
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function testAdminLogout()
    {
        $response = $this->get('/admin/logout');

        $response->assertRedirect('/admin/login');
        $this->assertGuest('admin');
    }
}
