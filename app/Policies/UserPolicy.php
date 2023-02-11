<?php

namespace App\Policies;

use App\AlterBase\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Filter authorization before checking permissions
     *
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if ($user->isSuperuser()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission('cms::users.index');
    }

    /**
     * Determine whether the user can create users.
     *
     * @param  \App\AlterBase\Models\User\User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->hasPermission('cms::users.create');
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\AlterBase\Models\User\User $user
     * @return bool
     */
    public function update(User $user)
    {
        return $user->hasPermission('cms::users.update');
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\AlterBase\Models\User\User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->hasPermission('cms::users.delete');
    }
}
