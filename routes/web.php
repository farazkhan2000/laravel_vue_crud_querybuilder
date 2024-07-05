<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/get-students', [StudentController::class, 'getStudents']);
Route::get('/get-single-student/{id}', [StudentController::class, 'getSingleStudent']);
Route::post('/add-student', [StudentController::class, 'addStudent']);
Route::put('/update-student/{id}', [StudentController::class, 'updateStudent']);
Route::delete('/delete-student/{id}', [StudentController::class, 'deleteStudent']);

Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');