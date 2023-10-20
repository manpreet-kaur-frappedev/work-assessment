<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        // If User is Admin; don't run any checks; just allow.
        if($user->isAdmin()) {
            return true;
        }
    
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        $permissions = $user->getPermissions();
        return $permissions->where('slug', 'task-listing')->count() > 0;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        $permissions = $user->getPermissions();

        // Viewable if the User has task-listing permission & User is the one assigned to the task.
        return ($user->id === $task->assign_to) && ($permissions->where('slug', 'task-listing')->count() > 0);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $permissions = $user->getPermissions();
        return $permissions->where('slug', 'task-create')->count() > 0;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        $permissions = $user->getPermissions();
        return $permissions->where('slug', 'task-update')->count() > 0;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        $permissions = $user->getPermissions();
        return $permissions->where('slug', 'task-delete')->count() > 0;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Task $task): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Task $task): bool
    {
        //
    }
}
