<?php

namespace App\Http\Controllers;

use App\Models\Failure;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class FailureController extends Controller
{
    public function __construct()
    {
        //$this->middleware("can:failure.index")->only("index");
        $this->middleware("can:failure.edit")->only("edit", "update");
        $this->middleware("can:failure.create")->only("create", "store");
        $this->middleware("can:failure.delete")->only("destroy");
    }

    function validarFormCreate(Request $request)
    {
        $request->validate([
            "picture" => "required|image",
            "location" => "required|string|min:3|max:40",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "description" => "required|string|min:3|max:150",
            "date" => "required|date",
            "states_id" => "required|numeric",
            "users_id" => "required|numeric"
        ]);
    }

    function validarFormEdit(Request $request)
    {
        $request->validate([
            "location" => "required|string|min:3|max:40",
            "latitude" => "required|numeric",
            "longitude" => "required|numeric",
            "description" => "required|string|min:3|max:150",
            "date" => "required|date",
            "states_id" => "required|numeric",
            "users_id" => "required|numeric"
        ]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $failures = Failure::paginate(8);
        return view("failure_index", ["failures" => $failures]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $states = State::all();
        return view("failure_create", ["states" => $states]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request["users_id"] = Auth::id();
        $this->validarFormCreate($request);
        $input = $request->all();
        $picture = $request->file("picture");
        $pictureName = date("YmdHis") . "." . $picture->getClientOriginalExtension();
        $picturePath = "images/failures";

        $picture->move($picturePath, $pictureName);
        $input["picture"] = $pictureName;

        $newFailure = Failure::create($input);
        return redirect()->route("failures.index")->with(["message" => "Registro creado exitosamente"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Failure $failure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Failure $failure)
    {
        $states = State::all();
        return view("failure_edit", ["failure" => $failure, "states" => $states]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Failure $failure)
    {
        $request["users_id"] = Auth::id();
        $this->validarFormEdit($request);
        if ($picture = $request->file("picture")) {
            $archivoAEliminar = "images/failures/$failure->picture";
            if (file_exists($archivoAEliminar))
                unlink($archivoAEliminar);
            $input = $request->all();
            $pictureName = date("YmdHis") . "." . $picture->getClientOriginalExtension();
            $picturePath = "images/failures";
            $picture->move($picturePath, $pictureName);
            $input["picture"] = $pictureName;
            $failure->update($input);
        } else
            $failure->update($request->all());
        return redirect()->route("failures.index")->with(["message" => "Registro editado exitosamente"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Failure $failure)
    {

        $archivoAEliminar = "images/failures/$failure->picture";
        if (file_exists($archivoAEliminar))
            unlink($archivoAEliminar);
        $failure->delete();
        return redirect()->route("failures.index")->with(["message" => "Registro eliminado exitosamente"]);
    }

    public function report()
    {
        $failures = Failure::all();
        //return view("failure_report", ["failures" => $failures]);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView("failure_report", ["failures"=>$failures]);
        $pdf->setPaper("letter", "portrait")->setWarnings(false);
        return $pdf->stream();
    }
}
