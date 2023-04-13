<?php

namespace App\Policies;

use App\AlterBase\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
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
     * Determine whether the user can update the profile from settings.
     *
     * @param User $user
     * @return bool
     */
    public function profile(User $user)
    {
        return $user->hasPermission('cms::settings.profile');
    }

    /**
     * Determine whether the user can view messages.
     *
     * @param  \App\AlterBase\Models\User\User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->hasPermission('cms::settings.message');
    }

    /**
     * Determine whether the user can send message.
     *
     * @param  \App\AlterBase\Models\User\User $user
     * @return bool
     */
    public function send(User $user)
    {
        return $user->hasPermission('cms::settings.message.send');
    }
}
