<?php

namespace App\Policies;

use App\User;
use App\Empleado;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpleadoPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isAdmin() || $user->isSystem()) {
           return true;
        }
    }

    public function menu($user)
    {
        return false; //($user->isAdmin() || $user->isSystem());
    }

    /**
     * Determine whether the user can view any empleados.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the empleado.
     *
     * @param  \App\User  $user
     * @param  \App\Empleado  $empleado
     * @return mixed
     */
    public function view(User $user, Empleado $empleado)
    {
        return false;
    }

    /**
     * Determine whether the user can create empleados.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the empleado.
     *
     * @param  \App\User  $user
     * @param  \App\Empleado  $empleado
     * @return mixed
     */
    public function update(User $user, Empleado $empleado)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the empleado.
     *
     * @param  \App\User  $user
     * @param  \App\Empleado  $empleado
     * @return mixed
     */
    public function delete(User $user, Empleado $empleado)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the empleado.
     *
     * @param  \App\User  $user
     * @param  \App\Empleado  $empleado
     * @return mixed
     */
    public function restore(User $user, Empleado $empleado)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the empleado.
     *
     * @param  \App\User  $user
     * @param  \App\Empleado  $empleado
     * @return mixed
     */
    public function forceDelete(User $user, Empleado $empleado)
    {
        return false;
    }
}
