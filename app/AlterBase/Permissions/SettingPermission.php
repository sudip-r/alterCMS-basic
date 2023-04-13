<?php

namespace App\AlterBase\Permissions;

use App\AlterBase\StorePermissions;

class SettingPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'My Profile',
            'slug' => 'cms::profile',
            'description' => 'Profile and Messages',
            'icon_class' => 'fa-user-cog',
        ],
        'actions' => [
            [
                'name' => 'Update User Setting',
                'slug' => 'cms::profile.setting',
                'description' => 'Allow users to update user setting',
                'view_on_sidebar' => true,
                'menu_name' => "Update Profile",
            ]
        ],
    ];

    /**
     * Store permissions related to users module
     *
     */
    public function store()
    {
        return StorePermissions::add($this->permissions);
    }
}
