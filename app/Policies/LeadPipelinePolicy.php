<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeadPipeline;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPipelinePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the leadPipeline can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list leadpipelines');
    }

    /**
     * Determine whether the leadPipeline can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipeline  $model
     * @return mixed
     */
    public function view(User $user, LeadPipeline $model)
    {
        return $user->hasPermissionTo('view leadpipelines');
    }

    /**
     * Determine whether the leadPipeline can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create leadpipelines');
    }

    /**
     * Determine whether the leadPipeline can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipeline  $model
     * @return mixed
     */
    public function update(User $user, LeadPipeline $model)
    {
        return $user->hasPermissionTo('update leadpipelines');
    }

    /**
     * Determine whether the leadPipeline can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipeline  $model
     * @return mixed
     */
    public function delete(User $user, LeadPipeline $model)
    {
        return $user->hasPermissionTo('delete leadpipelines');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipeline  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete leadpipelines');
    }

    /**
     * Determine whether the leadPipeline can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipeline  $model
     * @return mixed
     */
    public function restore(User $user, LeadPipeline $model)
    {
        return false;
    }

    /**
     * Determine whether the leadPipeline can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadPipeline  $model
     * @return mixed
     */
    public function forceDelete(User $user, LeadPipeline $model)
    {
        return false;
    }
}
