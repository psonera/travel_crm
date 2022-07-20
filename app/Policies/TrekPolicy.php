<?php

namespace App\Policies;

use App\Models\Trek;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrekPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the trek can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list treks');
    }

    /**
     * Determine whether the trek can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trek  $model
     * @return mixed
     */
    public function view(User $user, Trek $model)
    {
        return $user->hasPermissionTo('view treks');
    }

    /**
     * Determine whether the trek can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create treks');
    }

    /**
     * Determine whether the trek can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trek  $model
     * @return mixed
     */
    public function update(User $user, Trek $model)
    {
        return $user->hasPermissionTo('update treks');
    }

    /**
     * Determine whether the trek can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trek  $model
     * @return mixed
     */
    public function delete(User $user, Trek $model)
    {
        return $user->hasPermissionTo('delete treks');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trek  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete treks');
    }

    /**
     * Determine whether the trek can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trek  $model
     * @return mixed
     */
    public function restore(User $user, Trek $model)
    {
        return false;
    }

    /**
     * Determine whether the trek can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Trek  $model
     * @return mixed
     */
    public function forceDelete(User $user, Trek $model)
    {
        return false;
    }
}
