<?php

namespace App\Traits;

use App\Role;

/**
 * 
 */
trait UserRoles
{

	/**
	 * Return default User Role.
	 */
	public function role()
	{
		return $this->belongsTo('App\Role');
	}
	/**
	 * Return alternative User Roles.
	 */
	public function roles()
	{
		return $this->belongsToMany('App\Role', 'user_roles');
	}
	/**
	 * Return all User Roles, merging the default and alternative roles.
	 */
	public function roles_all()
	{
		$this->loadRolesRelations();
		return collect([$this->role])->merge($this->roles);
	}
	/**
	 * Check if User has a Role(s) associated.
	 *
	 * @param string|array $name The role(s) to check.
	 *
	 * @return bool
	 */
	public function hasRole($name)
	{
		$roles = $this->roles_all()->pluck('slug')->toArray();
		foreach ((is_array($name) ? $name : [$name]) as $role) {
			if (in_array($role, $roles)) {
				return true;
			}
		}
		return false;
	}
	/**
	 * Set default User Role.
	 *
	 * @param string $name The role name to associate.
	 */
	public function setRole($name)
	{
		$role = Role::where('slug', '=', $name)->first();
		if ($role) {
			$this->role()->associate($role);
			$this->save();
		}
		return $this;
	}

	private function loadRolesRelations()
	{
		if (!$this->relationLoaded('role')) {
			$this->load('role');
		}
		if (!$this->relationLoaded('roles')) {
			$this->load('roles');
		}
	}
}
