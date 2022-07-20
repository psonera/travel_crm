<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeadPipelineStage;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPipelineStagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the leadPipelineStage can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list leadpipelinestages');
    }

    /**
     * Determine whether the leadPipelineStage can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipelineStage  $model
     * @return mixed
     */
    public function view(User $user, LeadPipelineStage $model)
    {
        return $user->hasPermissionTo('view leadpipelinestages');
    }

    /**
     * Determine whether the leadPipelineStage can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create leadpipelinestages');
    }

    /**
     * Determine whether the leadPipelineStage can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipelineStage  $model
     * @return mixed
     */
    public function update(User $user, LeadPipelineStage $model)
    {
        return $user->hasPermissionTo('update leadpipelinestages');
    }

    /**
     * Determine whether the leadPipelineStage can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipelineStage  $model
     * @return mixed
     */
    public function delete(User $user, LeadPipelineStage $model)
    {
        return $user->hasPermissionTo('delete leadpipelinestages');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipelineStage  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete leadpipelinestages');
    }

    /**
     * Determine whether the leadPipelineStage can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipelineStage  $model
     * @return mixed
     */
    public function restore(User $user, LeadPipelineStage $model)
    {
        return false;
    }

    /**
     * Determine whether the leadPipelineStage can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipelineStage  $model
     * @return mixed
     */
    public function forceDelete(User $user, LeadPipelineStage $model)
    {
        return false;
    }
}
