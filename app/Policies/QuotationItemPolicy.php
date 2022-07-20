<?php

namespace App\Policies;

use App\Models\User;
use App\Models\QuotationItem;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotationItemPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the quotationItem can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list quotationitems');
    }

    /**
     * Determine whether the quotationItem can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuotationItem  $model
     * @return mixed
     */
    public function view(User $user, QuotationItem $model)
    {
        return $user->hasPermissionTo('view quotationitems');
    }

    /**
     * Determine whether the quotationItem can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create quotationitems');
    }

    /**
     * Determine whether the quotationItem can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuotationItem  $model
     * @return mixed
     */
    public function update(User $user, QuotationItem $model)
    {
        return $user->hasPermissionTo('update quotationitems');
    }

    /**
     * Determine whether the quotationItem can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuotationItem  $model
     * @return mixed
     */
    public function delete(User $user, QuotationItem $model)
    {
        return $user->hasPermissionTo('delete quotationitems');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuotationItem  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete quotationitems');
    }

    /**
     * Determine whether the quotationItem can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuotationItem  $model
     * @return mixed
     */
    public function restore(User $user, QuotationItem $model)
    {
        return false;
    }

    /**
     * Determine whether the quotationItem can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\QuotationItem  $model
     * @return mixed
     */
    public function forceDelete(User $user, QuotationItem $model)
    {
        return false;
    }
}
