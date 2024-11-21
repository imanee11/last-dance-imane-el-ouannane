<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [
        "name",
        "description",
        "start",
        "end",
        "priority",
        "status",
        "user_id",
        "team_id",
        "assigned_to"
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
