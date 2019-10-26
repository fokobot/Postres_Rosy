<?php

namespace App\Policies;

use App\User;
use App\Proveedor;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProveedorPolicy
{
    use HandlesAuthorization;
    
    public function before($user, $ability)
    {
        if ($user->admin() || $user->system()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any proveedors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\Proveedor  $proveedor
     * @return mixed
     */
    public function view(User $user, Proveedor $proveedor)
    {
        return true;
    }

    /**
     * Determine whether the user can create proveedors.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\Proveedor  $proveedor
     * @return mixed
     */
    public function update(User $user, Proveedor $proveedor)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\Proveedor  $proveedor
     * @return mixed
     */
    public function delete(User $user, Proveedor $proveedor)
    {
        return true;
    }

    /**
     * Determine whether the user can restore the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\Proveedor  $proveedor
     * @return mixed
     */
    public function restore(User $user, Proveedor $proveedor)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the proveedor.
     *
     * @param  \App\User  $user
     * @param  \App\Proveedor  $proveedor
     * @return mixed
     */
    public function forceDelete(User $user, Proveedor $proveedor)
    {
        return true;
    }
}
