<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeadStage;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadStagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the leadStage can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list leadstages');
    }

    /**
     * Determine whether the leadStage can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadStage  $model
     * @return mixed
     */
    public function view(User $user, LeadStage $model)
    {
        return $user->hasPermissionTo('view leadstages');
    }

    /**
     * Determine whether the leadStage can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create leadstages');
    }

    /**
     * Determine whether the leadStage can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadStage  $model
     * @return mixed
     */
    public function update(User $user, LeadStage $model)
    {
        return $user->hasPermissionTo('update leadstages');
    }

    /**
     * Determine whether the leadStage can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadStage  $model
     * @return mixed
     */
    public function delete(User $user, LeadStage $model)
    {
        return $user->hasPermissionTo('delete leadstages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadStage  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete leadstages');
    }

    /**
     * Determine whether the leadStage can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadStage  $model
     * @return mixed
     */
    public function restore(User $user, LeadStage $model)
    {
        return false;
    }

    /**
     * Determine whether the leadStage can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadStage  $model
     * @return mixed
     */
    public function forceDelete(User $user, LeadStage $model)
    {
        return false;
    }
}
