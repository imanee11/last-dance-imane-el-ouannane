<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); 
        // Only get tasks that don't belong to any team (personal tasks)
        $personalTasks = auth()->user()->tasks()
            ->whereNull('team_id')
            ->orderBy('created_at', 'desc')
            ->get(); 
        return view('task.index', compact('personalTasks', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'priority' => $request->priority,
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);
        
        return redirect()->back()->with('success', 'Personal task created successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Ensure the task is a personal task
        if ($task->team_id !== null) {
            return redirect()->back()->with('error', 'Cannot modify team tasks here.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'priority' => 'required|in:low,medium,high',
        ]);

        $task->update([
            "name" => $request->name,
            "description" => $request->description,
            "start" => $request->start,
            "end" => $request->end,
            "priority" => $request->priority,
        ]);

        return redirect()->back()->with('info', 'Personal task updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Ensure the task is a personal task
        if ($task->team_id !== null) {
            return redirect()->back()->with('error', 'Cannot delete team tasks here.');
        }

        $this->authorize('delete', $task);
        $task->delete();

        return redirect()->back()->with('error', 'Personal task deleted successfully!');
    }
}