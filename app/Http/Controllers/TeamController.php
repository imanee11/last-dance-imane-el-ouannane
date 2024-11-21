<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = Auth::user(); 
        // $teams = auth()->user()->teams()->orderBy('created_at', 'desc')->get(); 
        $teams = Team::all();

        return view('team.index' , compact('user' , 'teams'));
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
            'image' => 'nullable',
        ]);


        $image = $request->image;
        $imageName = hash("sha256", file_get_contents($image)) . "." . $image->getClientOriginalExtension();
        $image->move(storage_path("app/public/images"), $imageName);


        $team = Team::create([
            'name' => $request->name,
            'description' => $request->description,
            "image" => $imageName,
            'owner_id' => auth()->id(),
        ]);
    

        // dd($request);
        return redirect()->back()->with('success', 'Team created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
        $user = Auth::user(); 
        return view('team.detail' , compact("team" , "user"));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        //
    }
}
