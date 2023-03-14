<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\API\StudentController;
use App\Http\Resources\TeacherResource;

Route::post('/add-student', [StudentController::class, 'store']);
Route::get('/get-student', [StudentController::class, 'index']);
Route::delete('/del-student/{id}', [StudentController::class, 'destroy']);
Route::put('/edit-student/{id}', [StudentController::class, 'update']);

Route::get('/teacher', function () {
    return \App\Http\Resources\StudentResource::collection(\App\Models\Student::all());
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
