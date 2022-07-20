<?php

namespace App\Policies;

use App\Models\User;
use App\Models\EmailTemplate;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmailTemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the emailTemplate can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list emailtemplates');
    }

    /**
     * Determine whether the emailTemplate can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmailTemplate  $model
     * @return mixed
     */
    public function view(User $user, EmailTemplate $model)
    {
        return $user->hasPermissionTo('view emailtemplates');
    }

    /**
     * Determine whether the emailTemplate can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create emailtemplates');
    }

    /**
     * Determine whether the emailTemplate can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmailTemplate  $model
     * @return mixed
     */
    public function update(User $user, EmailTemplate $model)
    {
        return $user->hasPermissionTo('update emailtemplates');
    }

    /**
     * Determine whether the emailTemplate can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmailTemplate  $model
     * @return mixed
     */
    public function delete(User $user, EmailTemplate $model)
    {
        return $user->hasPermissionTo('delete emailtemplates');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmailTemplate  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete emailtemplates');
    }

    /**
     * Determine whether the emailTemplate can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmailTemplate  $model
     * @return mixed
     */
    public function restore(User $user, EmailTemplate $model)
    {
        return false;
    }

    /**
     * Determine whether the emailTemplate can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\EmailTemplate  $model
     * @return mixed
     */
    public function forceDelete(User $user, EmailTemplate $model)
    {
        return false;
    }
}
