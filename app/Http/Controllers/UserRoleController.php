<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:role.edit")->only("edit", "update");
    }

    public function edit($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        return view("user_role_edit", ["user" => $user, "roles" => $roles]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->syncRoles($request["roles"]);
        return redirect()->route("users.index")->with(["message" => "Roles actualizados"]);
    }
}
