<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function puedo_autenticarme()
    {
        return User::where("email", "admin@admin.com")->first();
    }

    public function test_index_method()
    {
        //Autenticarse
        $user = $this->puedo_autenticarme();
        $this->actingAs($user);
        //Simular una solicitud HTTP
        $response = $this->get(route("users.index"));
        $response->assertStatus(200);
    }

    public function test_create_method()
    {
        //Autenticarse
        $user = $this->puedo_autenticarme();
        $this->actingAs($user);
        //Simular una solicitud HTTP
        $response = $this->get(route("users.create"));
        $response->assertStatus(200);
    }

    public function test_store_method()
    {
        //Autenticarse
        $user = $this->puedo_autenticarme();
        $this->actingAs($user);
        //Simular una solicitud HTTP usando $this->post
        $this->post(route('users.store'), [
            'name' => 'unusuario',
            'email' => 'unusuario@unusuario.com',
            'password' => '12345678',
        ]);
        //Asegurarse de que se haya creado un usuario.
        $this->assertDatabaseHas('users', ['email' => 'unusuario@unusuario.com']);
    }

    public function test_edit_method()
    {
        //Autenticarse
        $user = $this->puedo_autenticarme();
        $this->actingAs($user);
        //Hacer una petición HTTP
        $response = $this->get(route("users.edit", [1]));
        $response->assertStatus(200);
    }

    public function test_update_method()
    {
        //Autenticarse
        $user = $this->puedo_autenticarme();
        $this->actingAs($user);
        //Simular una solicitud HTTP
        $unUsuario = User::where("email", "unusuario@unusuario.com")->first();
        $this->put(route("users.update", [$unUsuario]), [
            "name" => "unusuario2", "email" => "unusuario2@unusuario2.com", "password"=>87654321,
        ]);
        $this->assertDatabaseHas("users", ["email"=>"unusuario2@unusuario2.com"]);
    }

    public function test_destroy_method()
    {
        //Autenticarse
        $user = $this->puedo_autenticarme();
        $this->actingAs($user);
        //Simular la petición
        $unUsuario = User::where("email", "unusuario2@unusuario2.com")->first();
        $this->delete(route("users.destroy", [$unUsuario]));
        $this->assertDatabaseMissing("users", ["email" => "unusuario2@unusuario2.com"]);
    }
}
