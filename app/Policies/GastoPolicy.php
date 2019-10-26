<?php

namespace App\Policies;

use App\User;
use App\Gasto;
use Illuminate\Auth\Access\HandlesAuthorization;

class GastoPolicy
{
    use HandlesAuthorization;
    
    public function before($user, $ability)
    {
        if ($user->admin() || $user->system()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any gastos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the gasto.
     *
     * @param  \App\User  $user
     * @param  \App\Gasto  $gasto
     * @return mixed
     */
    public function view(User $user, Gasto $gasto)
    {
        return true;
    }

    /**
     * Determine whether the user can create gastos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the gasto.
     *
     * @param  \App\User  $user
     * @param  \App\Gasto  $gasto
     * @return mixed
     */
    public function update(User $user, Gasto $gasto)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the gasto.
     *
     * @param  \App\User  $user
     * @param  \App\Gasto  $gasto
     * @return mixed
     */
    public function delete(User $user, Gasto $gasto)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the gasto.
     *
     * @param  \App\User  $user
     * @param  \App\Gasto  $gasto
     * @return mixed
     */
    public function restore(User $user, Gasto $gasto)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the gasto.
     *
     * @param  \App\User  $user
     * @param  \App\Gasto  $gasto
     * @return mixed
     */
    public function forceDelete(User $user, Gasto $gasto)
    {
        return true;
    }
}
