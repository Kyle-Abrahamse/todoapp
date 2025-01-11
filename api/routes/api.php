<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\AuthController;

Route::get("/test", function () {
    return response() -> json(["message" => "Api has two gay cats"]);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');



Route::get("/todo", [TodoController::class, "index"]);
Route::post("/todo", [TodoController::class, "store"]);
Route::patch("/todo/{id}", [TodoController::class, "update"]);
Route::delete("/todo/{id}", [TodoController::class, "destroy"]);