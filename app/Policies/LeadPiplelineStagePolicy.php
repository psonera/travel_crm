<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeadPiplelineStage;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPiplelineStagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the leadPiplelineStage can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list leadpiplelinestages');
    }

    /**
     * Determine whether the leadPiplelineStage can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPiplelineStage  $model
     * @return mixed
     */
    public function view(User $user, LeadPiplelineStage $model)
    {
        return $user->hasPermissionTo('view leadpiplelinestages');
    }

    /**
     * Determine whether the leadPiplelineStage can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create leadpiplelinestages');
    }

    /**
     * Determine whether the leadPiplelineStage can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPiplelineStage  $model
     * @return mixed
     */
    public function update(User $user, LeadPiplelineStage $model)
    {
        return $user->hasPermissionTo('update leadpiplelinestages');
    }

    /**
     * Determine whether the leadPiplelineStage can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPiplelineStage  $model
     * @return mixed
     */
    public function delete(User $user, LeadPiplelineStage $model)
    {
        return $user->hasPermissionTo('delete leadpiplelinestages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPiplelineStage  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete leadpiplelinestages');
    }

    /**
     * Determine whether the leadPiplelineStage can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPiplelineStage  $model
     * @return mixed
     */
    public function restore(User $user, LeadPiplelineStage $model)
    {
        return false;
    }

    /**
     * Determine whether the leadPiplelineStage can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPiplelineStage  $model
     * @return mixed
     */
    public function forceDelete(User $user, LeadPiplelineStage $model)
    {
        return false;
    }
}
