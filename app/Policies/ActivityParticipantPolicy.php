<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ActivityParticipant;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityParticipantPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the activityParticipant can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list activityparticipants');
    }

    /**
     * Determine whether the activityParticipant can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActivityParticipant  $model
     * @return mixed
     */
    public function view(User $user, ActivityParticipant $model)
    {
        return $user->hasPermissionTo('view activityparticipants');
    }

    /**
     * Determine whether the activityParticipant can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create activityparticipants');
    }

    /**
     * Determine whether the activityParticipant can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActivityParticipant  $model
     * @return mixed
     */
    public function update(User $user, ActivityParticipant $model)
    {
        return $user->hasPermissionTo('update activityparticipants');
    }

    /**
     * Determine whether the activityParticipant can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActivityParticipant  $model
     * @return mixed
     */
    public function delete(User $user, ActivityParticipant $model)
    {
        return $user->hasPermissionTo('delete activityparticipants');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActivityParticipant  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete activityparticipants');
    }

    /**
     * Determine whether the activityParticipant can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActivityParticipant  $model
     * @return mixed
     */
    public function restore(User $user, ActivityParticipant $model)
    {
        return false;
    }

    /**
     * Determine whether the activityParticipant can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\ActivityParticipant  $model
     * @return mixed
     */
    public function forceDelete(User $user, ActivityParticipant $model)
    {
        return false;
    }
}
