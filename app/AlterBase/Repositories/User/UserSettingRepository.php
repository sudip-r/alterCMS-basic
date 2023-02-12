<?php

namespace App\AlterBase\Repositories\User;

use App\AlterBase\Repositories\Repository;

class UserSettingRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\AlterBase\Models\User\UserSetting';
    }
}