<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeadManager;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadManagerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the leadManager can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list leadmanagers');
    }

    /**
     * Determine whether the leadManager can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadManager  $model
     * @return mixed
     */
    public function view(User $user, LeadManager $model)
    {
        return $user->hasPermissionTo('view leadmanagers');
    }

    /**
     * Determine whether the leadManager can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create leadmanagers');
    }

    /**
     * Determine whether the leadManager can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadManager  $model
     * @return mixed
     */
    public function update(User $user, LeadManager $model)
    {
        return $user->hasPermissionTo('update leadmanagers');
    }

    /**
     * Determine whether the leadManager can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadManager  $model
     * @return mixed
     */
    public function delete(User $user, LeadManager $model)
    {
        return $user->hasPermissionTo('delete leadmanagers');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadManager  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete leadmanagers');
    }

    /**
     * Determine whether the leadManager can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadManager  $model
     * @return mixed
     */
    public function restore(User $user, LeadManager $model)
    {
        return false;
    }

    /**
     * Determine whether the leadManager can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadManager  $model
     * @return mixed
     */
    public function forceDelete(User $user, LeadManager $model)
    {
        return false;
    }
}
