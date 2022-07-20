<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Quotation;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the quotation can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list quotations');
    }

    /**
     * Determine whether the quotation can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Quotation  $model
     * @return mixed
     */
    public function view(User $user, Quotation $model)
    {
        return $user->hasPermissionTo('view quotations');
    }

    /**
     * Determine whether the quotation can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create quotations');
    }

    /**
     * Determine whether the quotation can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Quotation  $model
     * @return mixed
     */
    public function update(User $user, Quotation $model)
    {
        return $user->hasPermissionTo('update quotations');
    }

    /**
     * Determine whether the quotation can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Quotation  $model
     * @return mixed
     */
    public function delete(User $user, Quotation $model)
    {
        return $user->hasPermissionTo('delete quotations');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Quotation  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete quotations');
    }

    /**
     * Determine whether the quotation can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Quotation  $model
     * @return mixed
     */
    public function restore(User $user, Quotation $model)
    {
        return false;
    }

    /**
     * Determine whether the quotation can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Quotation  $model
     * @return mixed
     */
    public function forceDelete(User $user, Quotation $model)
    {
        return false;
    }
}
