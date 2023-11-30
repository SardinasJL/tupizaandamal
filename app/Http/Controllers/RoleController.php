<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:role.index")->only("index");
        $this->middleware("can:role.create")->only("create", "store");
        $this->middleware("can:role.edit")->only("edit", "update");
        $this->middleware("can:role.delete")->only("destroy");
    }

    public function validarForm(Request $request)
    {
        $request->validate([
            "name" => "required|string|min:3|max:30"
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view("role_index", ["roles" => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("role_create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validarForm($request);
        Role::create($request->all());
        return redirect()->route("roles.index")->with(["message" => "Rol creado exitosamente"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        return view("role_edit", ["role" => $role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validarForm($request);
        $role = Role::find($id);
        $role->update($request->all());
        return redirect()->route("roles.index")->with(["message" => "Rol editado exitosamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();
        return redirect()->route("roles.index")->with(["message" => "Rol eliminado exitosamente"]);
    }
}
