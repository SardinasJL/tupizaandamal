<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StateTest extends TestCase
{
    public function puedo_autenticarme()
    {
        return User::where("email", "admin@admin.com")->first();
    }
    
    public function test_can_see_states()
    {
        $user = $this->puedo_autenticarme();
        $this->actingAs($user);
        $response = $this->get("/states");
        $response->assertStatus(200);
    }




}
