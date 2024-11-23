<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;
    public $acceptUrl;
    public $rejectUrl;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
        $this->acceptUrl = route('invitation.respond', [
            'invitation' => $invitation->id,
            'response' => 'accept',
            'email' => $invitation->email
        ]);
        $this->rejectUrl = route('invitation.respond', [
            'invitation' => $invitation->id,
            'response' => 'reject',
            'email' => $invitation->email
        ]);
    }

    public function build()
    {
        return $this->markdown('team.mail')->subject('Team Invitation');
    }
}


