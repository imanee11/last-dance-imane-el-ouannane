<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    //
    protected $fillable = [
        "team_id",
        "email",
        "status",
        'invited_by'
    ];

    public function team(){
        return $this->belongsTo(Team::class , 'team_id');
    }

    public function owner(){
        return $this->belongsTo(User::class , 'invited_by');
    }
}
