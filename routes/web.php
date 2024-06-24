<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route("failures.index");
});

Auth::routes(["register" => false, "reset" => false]);

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource("failures", "App\Http\Controllers\FailureController")->only("index");
Route::get("/failures/report", "App\Http\Controllers\FailureController@report")->name("failures.report");//funciona muy bien!
Route::group(["middleware" => "auth"], function () {
    Route::resource("states", "App\Http\Controllers\StateController");
    Route::resource("failures", "App\Http\Controllers\FailureController")->except("index");
    Route::resource("users", "App\Http\Controllers\UserController");
    Route::get("users/{user}/roles", "App\Http\Controllers\UserRoleController@edit")->name("users.roles.edit");
    Route::put("users/{user}/roles", "App\Http\Controllers\UserRoleController@update")->name("users.roles.update");
    Route::resource("roles", "App\Http\Controllers\RoleController");
    Route::get("roles/{role}/permissions", "App\Http\Controllers\RolePermissionController@edit")->name("roles.permissions.edit");
    Route::put("roles/{role}/permissions", "App\Http\Controllers\RolePermissionController@update")->name("roles.permissions.update");
});

//Si esta ruta va al último, no funciona:
//Route::get("/failures/report", "App\Http\Controllers\FailureController@report")->name("failures.report");
