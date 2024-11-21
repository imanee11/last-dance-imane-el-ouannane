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
        //
        $user = Auth::user(); 
        $personalTasks = auth()->user()->tasks()->orderBy('created_at', 'desc')->get(); 
        return view('task.index' , compact('personalTasks' , 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'team_id' => 'nullable|exists:teams,id',
            'assigned_to' => 'nullable|exists:users,id',
        ]);


        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'start' => $request->start,
            'end' => $request->end,
            'priority' => $request->priority,
            'user_id' => auth()->id(),
            'team_id' => $request->team_id,
            'assigned_to' => $request->assigned_to,
        ]);

        // dd($request);
        
        return redirect()->back()->with('success', 'Task created successfully!');

        // return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start' => 'required|date',
            'end' => 'required|date',
            'priority' => 'required|in:low,medium,high',
            'team_id' => 'nullable|exists:teams,id',
            'assigned_to' => 'nullable|exists:users,id',
        ]);


        $task->update([
            "name" => $request->name,
            "description" => $request->description,
            "start" => $request->start,
            "end" => $request->end,
            "priority" => $request->priority,
            "team_id" => $request->team_id,
            "assigned_to" => $request->assigned_to,
        ]);


        // dd($request);
        // return back();
        return redirect()->back()->with('info', 'Task updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $this->authorize('delete', $task);

        $task->delete();


        return redirect()->back()->with('error', 'Task deleted successfully!');

    //   return back();
    }
}
