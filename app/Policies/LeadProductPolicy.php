<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeadProduct;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the leadProduct can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list leadproducts');
    }

    /**
     * Determine whether the leadProduct can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadProduct  $model
     * @return mixed
     */
    public function view(User $user, LeadProduct $model)
    {
        return $user->hasPermissionTo('view leadproducts');
    }

    /**
     * Determine whether the leadProduct can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create leadproducts');
    }

    /**
     * Determine whether the leadProduct can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadProduct  $model
     * @return mixed
     */
    public function update(User $user, LeadProduct $model)
    {
        return $user->hasPermissionTo('update leadproducts');
    }

    /**
     * Determine whether the leadProduct can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadProduct  $model
     * @return mixed
     */
    public function delete(User $user, LeadProduct $model)
    {
        return $user->hasPermissionTo('delete leadproducts');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadProduct  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete leadproducts');
    }

    /**
     * Determine whether the leadProduct can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadProduct  $model
     * @return mixed
     */
    public function restore(User $user, LeadProduct $model)
    {
        return false;
    }

    /**
     * Determine whether the leadProduct can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadProduct  $model
     * @return mixed
     */
    public function forceDelete(User $user, LeadProduct $model)
    {
        return false;
    }
}
