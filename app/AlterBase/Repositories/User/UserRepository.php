<?php

namespace App\AlterBase\Repositories\User;

use App\AlterBase\Repositories\Repository;

class UserRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    public function getModel()
    {
        return 'App\AlterBase\Models\User\User';
    }

    /**
     * Get all admin users
     * 
     * @return Collection
     */
    public function getAllAdmin()
    {
        return $this->model->from('users')
            ->where('guard', 'web')
            ->get();
    }
}
