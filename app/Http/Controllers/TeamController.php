<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get teams where user is owner or member
        $teams = Team::where('owner_id', $user->id)->orWhereHas('users', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('team.index', compact('user', 'teams'));
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



        $user = auth()->user();
        $teamCount = $user->ownedTeams()->count();

        // Check if user has reached the free team limit
        if ($teamCount >= 5 && !$user->isSubscribed()) {
            // Store team data in session for later
            session([
                'pending_team' => [
                    'name' => $request->name,
                    'description' => $request->description
                ]
            ]);

            return redirect()->route('subscription.show');
        }


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
    // public function update(Request $request, Team $team)
    // {
    //     //
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'image' => 'nullable',
    //     ]);

    //     $oldFilePath = storage_path("app/public/images/{$team->image}");

    //     if (file_exists($oldFilePath)) {
    //         unlink($oldFilePath);
    //     }

    //     // Store the new file
    //     $image = $request->image;
    //     $imageName = hash('sha256', file_get_contents($image)) . '.' . $image->getClientOriginalExtension();
    //     $image->move(storage_path('app/public/images'), $imageName);


    //     $team->update([
    //         "name" => $request->name,
    //         "description" => $request->description,
    //         'image' => $imageName,
    //     ]);

    //     return redirect()->back()->with('info', ' Team updated successfully!');

        

    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        if (Auth::id() !== $team->owner_id) {
            return redirect()->back()->with('error', 'Unauthorized. Only team owners can delete their teams.');
        }

        // Delete the team image if it exists
        if ($team->image) {
            $imagePath = storage_path("app/public/images/" . $team->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $team->delete();
        return redirect()->route('team.index')->with('success', 'Team deleted successfully!');
    }
}


