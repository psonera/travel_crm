<?php

namespace App\Policies;

use App\Models\User;
use App\Models\LeadSource;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadSourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the leadSource can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list leadsources');
    }

    /**
     * Determine whether the leadSource can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadSource  $model
     * @return mixed
     */
    public function view(User $user, LeadSource $model)
    {
        return $user->hasPermissionTo('view leadsources');
    }

    /**
     * Determine whether the leadSource can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create leadsources');
    }

    /**
     * Determine whether the leadSource can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadSource  $model
     * @return mixed
     */
    public function update(User $user, LeadSource $model)
    {
        return $user->hasPermissionTo('update leadsources');
    }

    /**
     * Determine whether the leadSource can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadSource  $model
     * @return mixed
     */
    public function delete(User $user, LeadSource $model)
    {
        return $user->hasPermissionTo('delete leadsources');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadSource  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete leadsources');
    }

    /**
     * Determine whether the leadSource can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadSource  $model
     * @return mixed
     */
    public function restore(User $user, LeadSource $model)
    {
        return false;
    }

    /**
     * Determine whether the leadSource can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\LeadSource  $model
     * @return mixed
     */
    public function forceDelete(User $user, LeadSource $model)
    {
        return false;
    }
}
