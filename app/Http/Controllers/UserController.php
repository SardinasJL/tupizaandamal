<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:user.index")->only("index");
        $this->middleware("can:user.create")->only("create", "store");
        $this->middleware("can:user.edit")->only("edit", "update");
        $this->middleware("can:user.delete")->only("destroy");
    }
    
    public function validarForm(Request $request)
    {
        $request->validate([
            "name" => "required|string|min:3|max:50",
            "email" => "required|email",
            "password" => "required|string|min:3|max:40"
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view("user_index", ["users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("user_create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validarForm($request);
        User::create($request->all());
        return redirect()->route("users.index")->with(["message" => "Usuario creado exitosamente"]);
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
        $user = User::find($id);
        return view("user_edit", ["user" => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->route("users.index")->with(["message" => "Usuario actulizado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route("users.index")->with(["message" => "Usuario borrado"]);
    }
}
