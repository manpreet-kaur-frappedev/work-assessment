<?php

namespace App\Providers;

use App\Models\Task;
use App\Models\User;
use App\Models\Role;
use App\Policies\UserPolicy;
use App\Policies\TaskPolicy;
use App\Policies\RolePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Task::class => TaskPolicy::class,
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('task-status-change', function (User $user, Task $task) {
            if($user->isAdmin()) {
                return true;
            }
            
            $permissions = $user->getPermissions();
            
            // first check if the user has task status changing permission
            $hasTaskStatusPermission = $permissions->where('slug', 'task-status-change')->count() > 0;

            if($hasTaskStatusPermission && $task) {
                return $task->assign_to == $user->id;
            }

            return $hasTaskStatusPermission;
        });

        Gate::define('task-comments', function (User $user, Task $task) {
            if($user->isAdmin()) {
                return true;
            }

            $permissions = $user->getPermissions();
            
            // first check if the user has task status changing permission
            $hasTaskCommentsPermission = $permissions->where('slug', 'task-comments')->count() > 0;

            if($hasTaskCommentsPermission && $task) {
                return $task->assign_to == $user->id;
            }

            return $hasTaskCommentsPermission;
        });

        Gate::define('task-uploads', function (User $user, Task $task) {
            if($user->isAdmin()) {
                return true;
            }

            $permissions = $user->getPermissions();
            
            // first check if the user has task status changing permission
            $hasTaskUploadsPermission = $permissions->where('slug', 'task-uploads')->count() > 0;

            if($hasTaskUploadsPermission && $task) {
                return $task->assign_to == $user->id;
            }

            return $hasTaskUploadsPermission;
        });


        Gate::define('task-assign', function (User $user, Task $task) {
            
            if($user->isAdmin()) {
                return true;
            }

            $permissions = $user->getPermissions();
            
            // first check if the user has task status changing permission
            $hasTaskAssignPermission = $permissions->where('slug', 'task-assign')->count() > 0;


            if($hasTaskAssignPermission && $task) {
                return $task->assign_to == $user->id;
            }

            return $hasTaskAssignPermission;
        });
    }
}
