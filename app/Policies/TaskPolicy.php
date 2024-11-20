<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function update(User $user, Task $task)
    {
        return $user->id === $task->user_id || ($task->team_id && $task->assigned_to === $user->id);
    }

    public function delete(User $user, Task $task)
    {
        return $user->id === $task->user_id;
    }

} 
