<?php
namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;
class TaskController extends Controller
{
    /**
     * Display the task list as an Inertia page.
     * Handles the basic server-side request (GET /tasks) and
     * hands the frontend real data straight from Eloquent.
     */
    public function index()
    {
        return Inertia::render('Tasks/Index', [
            'tasks' => Task::latest()->get(),
        ]);
    }
    /**
     * Store a newly created task.
     * Validates the request, persists it via Eloquent, then
     * redirects back so Inertia can refresh the page props.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);
        Task::create([
            'title' => $request->title,
            'is_done' => false,
        ]);
        return redirect()->back();
    }
    /**
     * Toggle / update a task (e.g. mark done or not done).
     */
    public function update(Request $request, Task $task)
    {
        $task->update([
            'is_done' => $request->boolean('is_done'),
        ]);
        return redirect()->back();
    }
    /**
     * Remove a task.
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->back();
    }
}
