<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function __construct()
    {
        $this->middleware("can:state.index")->only("index");
        $this->middleware("can:state.create")->only("create", "store");
        $this->middleware("can:state.edit")->only("edit", "update");
        $this->middleware("can:state.delete")->only("destroy");
    }

    /**
     * @param Request $request
     * @return void
     */
    function validarForm(Request $request)
    {
        $request->validate([
            "name" => "required|alpha:utf-8|min:3|max:40",
            "color" => "required|string|min:7|max:7",
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = State::all();
        return view("state_index", ["states" => $states]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("state_create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validarForm($request);
        $newState = State::create($request->all());
        return redirect()->route("states.index")->with(["message" => "Estado creado exitosamente"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(State $state)
    {
        return $state;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(State $state)
    {
        return view("state_edit", ["state" => $state]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, State $state)
    {
        $this->validarForm($request);
        $state->update($request->all());
        return redirect()->route("states.index")->with(["message" => "Estado editado exitosamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(State $state)
    {
        $state->delete();
        return redirect()->route("states.index")->with(["message" => "Estado eliminado exitosamente"]);
    }
}
