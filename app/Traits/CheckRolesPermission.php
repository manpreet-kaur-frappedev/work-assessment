<?php

namespace App\Traits;

use App\Models\Role;

trait CheckRolesPermission
{
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'users_roles');
	}

	// Get the permissions from roles assigned to user
	public function getPermissions()
	{
		$permissions = [];
		foreach($this->roles as $role) {
			foreach($role->permissions as $permission) {
				$permissions[] = $permission;
			}
		}

		return collect($permissions);
	}
}