<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait CheckRolesPermission
{
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'users_roles');
	}

	public function getPermissions()
	{
		$permissions = [];
		foreach($this->roles as $role) {
			foreach($role->permissions as $permission) {
				$permissions[] = $permission;
			}
		}

		return collect($permissions);
		// return $this->hasManyThrough(Permission::class, Role::class);
	}
}