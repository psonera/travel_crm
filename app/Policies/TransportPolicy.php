<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Transport;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the transport can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list transports');
    }

    /**
     * Determine whether the transport can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function view(User $user, Transport $model)
    {
        return $user->hasPermissionTo('view transports');
    }

    /**
     * Determine whether the transport can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create transports');
    }

    /**
     * Determine whether the transport can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function update(User $user, Transport $model)
    {
        return $user->hasPermissionTo('update transports');
    }

    /**
     * Determine whether the transport can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function delete(User $user, Transport $model)
    {
        return $user->hasPermissionTo('delete transports');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete transports');
    }

    /**
     * Determine whether the transport can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function restore(User $user, Transport $model)
    {
        return false;
    }

    /**
     * Determine whether the transport can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Transport  $model
     * @return mixed
     */
    public function forceDelete(User $user, Transport $model)
    {
        return false;
    }
}
