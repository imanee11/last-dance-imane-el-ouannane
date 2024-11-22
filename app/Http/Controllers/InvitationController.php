<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\Team;
use App\Models\User;
use App\Mail\InvitationMail;
use App\Mail\InvitationMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function invite(Request $request, Team $team)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Check if user is already a team member
        if ($team->users()->where('email', $request->email)->exists()) {
            return back()->with('error', 'User is already a team member.');
        }

        // Check if invitation already exists
        $existingInvitation = Invitation::where('team_id', $team->id)
            ->where('email', $request->email)
            ->where('status', 'Pending')
            ->first();

        if ($existingInvitation) {
            return back()->with('error', 'Invitation already sent to this email.');
        }

        // Create invitation
        $invitation = Invitation::create([
            'team_id' => $team->id,
            'email' => $request->email,
            'invited_by' => auth()->id(),
            'status' => 'Pending'
        ]);

        // Send invitation email
        Mail::to($request->email)->send(new InvitationMailer($invitation));

        return back()->with('success', 'Invitation sent successfully.');
    }

    public function respond(Request $request, Invitation $invitation)
    {
        if ($invitation->status !== 'Pending') {
            return redirect()->route('dashboard')
                ->with('error', 'This invitation has already been responded to.');
        }

        if ($request->email !== $invitation->email) {
            return redirect()->route('dashboard')
                ->with('error', 'Invalid invitation link.');
        }

        $response = $request->response;

        if ($response === 'accept') {
            // Find or create user
            $user = User::firstOrCreate(
                ['email' => $invitation->email],
                ['name' => explode('@', $invitation->email)[0]] // Temporary name
            );

            // Add user to team
            $invitation->team->users()->attach($user->id);
            $invitation->update(['status' => 'Accepted']);

            return redirect()->route('dashboard')
                ->with('success', 'That user have successfully joined the team.');
        } else {
            $invitation->update(['status' => 'Rejected']);
            return redirect()->route('dashboard')
                ->with('info', 'That user have declined the team invitation.');
        }
    }
}
