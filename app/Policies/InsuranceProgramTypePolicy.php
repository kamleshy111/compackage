<?php

namespace App\Policies;

use App\Models\User;
use App\Http\Controllers\CommonController;
use Illuminate\Auth\Access\HandlesAuthorization;

class InsuranceProgramTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if (CommonController::getPermissionForPolicies($user->id, 'view') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user) //, Benefit $benefit
    {
        if (CommonController::getPermissionForPolicies($user->id, 'view') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        if (CommonController::getPermissionForPolicies($user->id, 'create') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user) //, Benefit $benefit
    {
        if (CommonController::getPermissionForPolicies($user->id, 'update') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user) //, Benefit $benefit
    {
        if (CommonController::getPermissionForPolicies($user->id, 'delete') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user) //, Benefit $benefit
    {
        if (CommonController::getPermissionForPolicies($user->id, 'delete') ) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Benefit  $benefit
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user) //, Benefit $benefit
    {
        if (CommonController::getPermissionForPolicies($user->id, 'delete') ) {
            return true;
        }
        return false;
    }
}
