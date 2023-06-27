<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// To Do Tasks
Route::get('tasks', [TaskController::class, 'index'])->name('api.tasks');
Route::post('task/create', [TaskController::class, 'create'])->name('api.task.create');
Route::put('task/{id}', [TaskController::class, 'update'])->name('admin.task.update');
Route::delete('task/{id}/delete', [TaskController::class, 'delete'])->name('admin.task.delete');
