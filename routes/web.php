<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Renders the Inertia page (Tasks/Index.jsx) with the current task list
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');

// Creates a new task
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// Updates a task (used here to toggle is_done)
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

// Deletes a task
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// Redirect the root URL to the task list for convenience
Route::get('/', function () {
    return redirect()->route('tasks.index');
});
