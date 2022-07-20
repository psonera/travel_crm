<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TripType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the tripType can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list triptypes');
    }

    /**
     * Determine whether the tripType can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TripType  $model
     * @return mixed
     */
    public function view(User $user, TripType $model)
    {
        return $user->hasPermissionTo('view triptypes');
    }

    /**
     * Determine whether the tripType can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create triptypes');
    }

    /**
     * Determine whether the tripType can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TripType  $model
     * @return mixed
     */
    public function update(User $user, TripType $model)
    {
        return $user->hasPermissionTo('update triptypes');
    }

    /**
     * Determine whether the tripType can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TripType  $model
     * @return mixed
     */
    public function delete(User $user, TripType $model)
    {
        return $user->hasPermissionTo('delete triptypes');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TripType  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete triptypes');
    }

    /**
     * Determine whether the tripType can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TripType  $model
     * @return mixed
     */
    public function restore(User $user, TripType $model)
    {
        return false;
    }

    /**
     * Determine whether the tripType can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TripType  $model
     * @return mixed
     */
    public function forceDelete(User $user, TripType $model)
    {
        return false;
    }
}
