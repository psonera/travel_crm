<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Accomodation;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccomodationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the accomodation can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list accomodations');
    }

    /**
     * Determine whether the accomodation can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Accomodation  $model
     * @return mixed
     */
    public function view(User $user, Accomodation $model)
    {
        return $user->hasPermissionTo('view accomodations');
    }

    /**
     * Determine whether the accomodation can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create accomodations');
    }

    /**
     * Determine whether the accomodation can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Accomodation  $model
     * @return mixed
     */
    public function update(User $user, Accomodation $model)
    {
        return $user->hasPermissionTo('update accomodations');
    }

    /**
     * Determine whether the accomodation can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Accomodation  $model
     * @return mixed
     */
    public function delete(User $user, Accomodation $model)
    {
        return $user->hasPermissionTo('delete accomodations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Accomodation  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete accomodations');
    }

    /**
     * Determine whether the accomodation can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Accomodation  $model
     * @return mixed
     */
    public function restore(User $user, Accomodation $model)
    {
        return false;
    }

    /**
     * Determine whether the accomodation can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Accomodation  $model
     * @return mixed
     */
    public function forceDelete(User $user, Accomodation $model)
    {
        return false;
    }
}
