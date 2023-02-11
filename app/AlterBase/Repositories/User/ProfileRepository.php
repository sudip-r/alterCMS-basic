<?php

namespace App\AlterBase\Repositories\User;

use App\AlterBase\Repositories\Repository;

class ProfileRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\AlterBase\Models\User\Profile';
    }
}