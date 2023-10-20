<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class UserPolicy
{
    public function before(User $user, string $ability): bool|null
    {
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
        return $permissions->where('slug', 'employee-listing')->count() > 0;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $employee): bool
    {
        $permissions = $user->getPermissions();
        return $permissions->where('slug', 'employee-listing')->count() > 0;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $permissions = $user->getPermissions();
        return $permissions->where('slug', 'employee-create')->count() > 0;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $employee): bool
    {
        $permissions = $user->getPermissions();
        return $permissions->where('slug', 'employee-update')->count() > 0;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $employee): bool
    {
        $permissions = $user->getPermissions();
        return $permissions->where('slug', 'employee-delete')->count() > 0;
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
