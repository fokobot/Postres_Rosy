<?php

namespace App\Policies;

use App\User;
use App\Venta;
use Illuminate\Auth\Access\HandlesAuthorization;

class VentaPolicy
{
    use HandlesAuthorization;
    
    public function before($user, $ability)
    {
        if ($user->admin() || $user->system()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any ventas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the venta.
     *
     * @param  \App\User  $user
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function view(User $user, Venta $venta)
    {
        return true;
    }

    /**
     * Determine whether the user can create ventas.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the venta.
     *
     * @param  \App\User  $user
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function update(User $user, Venta $venta)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the venta.
     *
     * @param  \App\User  $user
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function delete(User $user, Venta $venta)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the venta.
     *
     * @param  \App\User  $user
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function restore(User $user, Venta $venta)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the venta.
     *
     * @param  \App\User  $user
     * @param  \App\Venta  $venta
     * @return mixed
     */
    public function forceDelete(User $user, Venta $venta)
    {
        return true;
    }
}
