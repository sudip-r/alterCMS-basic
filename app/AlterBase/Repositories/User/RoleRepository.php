<?php

namespace App\AlterBase\Repositories\User;

use App\AlterBase\Repositories\Repository;

class RoleRepository extends Repository
{

    /**
     * Get model name with namespace
     *
     * @return String
     */
    function getModel()
    {
        return 'App\AlterBase\Models\User\Role';
    }

    /**
     * Get list of roles
     *
     * @return array
     */
    public function getList()
    {
        return $this->model->orderBy('id','desc')->get(['name','id'])->pluck('name','id');
    }
}