<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamTaskController extends Controller
{
    /**
     * Display a listing of team tasks.
     */
    public function index(Team $team)
    {
        // Verify user is team member or owner
        if (!$team->owner_id === auth()->id() && !$team->users->contains(auth()->id())) {
            return redirect()->back()->with('error', 'You are not authorized to view tasks in this team.');
        }

        $tasks = $team->tasks()->orderBy('created_at', 'desc')->get();
        return view('team.tasks.index', compact('team', 'tasks'));
    }

    public function store(Request $request, Team $team)
    {
        // Validate that the user is the team owner or a member
        if (!$team->owner_id === auth()->id() && !$team->users->contains(auth()->id())) {
            return redirect()->back()->with('error', 'You are not authorized to create tasks in this team.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'priority' => 'required|in:low,medium,high',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        // Verify that assigned user is a team member
        if ($request->assigned_to) {
            if (!$team->users->contains($request->assigned_to)) {
                return redirect()->back()->with('error', 'Selected user is not a team member.');
            }
        }

        $task = Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'priority' => $request->priority,
            'status' => 'pending',
            'user_id' => auth()->id(),
            'team_id' => $team->id,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->back()->with('success', 'Team task created successfully!');
    }

    public function update(Request $request, Team $team, Task $task)
    {
        // Check if task belongs to the team
        if ($task->team_id !== $team->id) {
            return redirect()->back()->with('error', 'Task does not belong to this team.');
        }

        // Check if user can update the task
        if (!$team->owner_id === auth()->id() && $task->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this task.');
        }

        // Check if task deadline has passed
        if ($task->end < now()) {
            return redirect()->back()->with('error', 'Cannot update task with finished deadline.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,completed',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        // Verify that assigned user is a team member
        if ($request->assigned_to && !$team->users->contains($request->assigned_to)) {
            return redirect()->back()->with('error', 'Selected user is not a team member.');
        }

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'priority' => $request->priority,
            'status' => $request->status,
            'assigned_to' => $request->assigned_to,
        ]);

        return redirect()->back()->with('success', 'Team task updated successfully!');
    }

    public function destroy(Team $team, Task $task)
    {
        // Check if task belongs to the team
        if ($task->team_id !== $team->id) {
            return redirect()->back()->with('error', 'Task does not belong to this team.');
        }

        // Check if user can delete the task
        if (!$team->owner_id === auth()->id() && $task->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this task.');
        }

        $task->delete();

        return redirect()->back()->with('error', 'Team task deleted successfully!');
    }

    public function markAsCompleted(Team $team, Task $task)
    {
        // Check if task belongs to the team
        if ($task->team_id !== $team->id) {
            return redirect()->back()->with('error', 'Task does not belong to this team.');
        }

        // Check if user is assigned to the task or is team owner
        if (!$team->owner_id === auth()->id() && $task->assigned_to !== auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to mark this task as completed.');
        }

        $task->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'Task marked as completed!');
    }

}