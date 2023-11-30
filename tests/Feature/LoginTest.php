<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $response = $this->post('/login', [
            'email' => 'admin@admin.com',
            'password' => '12345678',
        ]);

        $response->assertRedirect('/failures');
    }
}
