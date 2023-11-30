<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Failure;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $admin = User::create(["name" => "admin", "email" => "admin@admin.com", "password" => bcrypt("12345678")]);
        $citizen = User::create(["name" => "citizen", "email" => "citizen@citizen.com", "password" => bcrypt("12345678")]);

        State::create(["name" => "solucionado", "color" => "#00FF00"]);
        State::create(["name" => "precaución", "color" => "#FFFF00"]);
        State::create(["name" => "peligro", "color" => "#FF0000"]);
        Failure::create([
            "picture" => "1.jpg",
            "location" => "Calle Bolívar",
            "latitude" => -21.446343,
            "longitude" => -65.720192,
            "description" => "Bache peligroso",
            "date" => "2023-11-4",
            "states_id" => 1,
            "users_id" => 1
        ]);

        Permission::create(["name" => "failure.index"]);
        Permission::create(["name" => "failure.create"]);
        Permission::create(["name" => "failure.edit"]);
        Permission::create(["name" => "failure.delete"]);
        Permission::create(["name" => "state.index"]);
        Permission::create(["name" => "state.create"]);
        Permission::create(["name" => "state.edit"]);
        Permission::create(["name" => "state.delete"]);
        Permission::create(["name" => "user.index"]);
        Permission::create(["name" => "user.create"]);
        Permission::create(["name" => "user.edit"]);
        Permission::create(["name" => "user.delete"]);
        Permission::create(["name" => "role.index"]);
        Permission::create(["name" => "role.create"]);
        Permission::create(["name" => "role.edit"]);
        Permission::create(["name" => "role.delete"]);
        Permission::create(["name" => "permission.index"]);
        Permission::create(["name" => "permission.create"]);
        Permission::create(["name" => "permission.edit"]);
        Permission::create(["name" => "permission.delete"]);

        $roleAdmin = Role::create(["name" => "admin"]);
        $roleCitizen = Role::create(["name" => "citizen"]);

        $roleAdmin->syncPermissions([
            "failure.index", "failure.create", "failure.edit", "failure.delete",
            "state.index", "state.create", "state.edit", "state.delete",
            "user.index", "user.create", "user.edit", "user.delete",
            "role.index", "role.create", "role.edit", "role.delete",
            "permission.index", "permission.create", "permission.edit", "permission.delete"
        ]);

        $roleCitizen->syncPermissions([
            "failure.index", "failure.create", "failure.edit", "failure.delete",
        ]);

        $admin->syncRoles(["admin"]);
        $citizen->syncRoles(["citizen"]);
    }
}
