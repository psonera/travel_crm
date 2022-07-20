<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeadType;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the leadType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list leadtypes');
    }

    /**
     * Determine whether the leadType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadType  $model
     * @return mixed
     */
    public function view(User $user, LeadType $model)
    {
        return $user->hasPermissionTo('view leadtypes');
    }

    /**
     * Determine whether the leadType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create leadtypes');
    }

    /**
     * Determine whether the leadType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadType  $model
     * @return mixed
     */
    public function update(User $user, LeadType $model)
    {
        return $user->hasPermissionTo('update leadtypes');
    }

    /**
     * Determine whether the leadType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadType  $model
     * @return mixed
     */
    public function delete(User $user, LeadType $model)
    {
        return $user->hasPermissionTo('delete leadtypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete leadtypes');
    }

    /**
     * Determine whether the leadType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadType  $model
     * @return mixed
     */
    public function restore(User $user, LeadType $model)
    {
        return false;
    }

    /**
     * Determine whether the leadType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadType  $model
     * @return mixed
     */
    public function forceDelete(User $user, LeadType $model)
    {
        return false;
    }
}
