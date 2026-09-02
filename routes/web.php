<?php

use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Redirect root to /tasks
Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// Task Routes
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');