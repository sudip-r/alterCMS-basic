<?php

namespace App\AlterBase\Permissions;


use App\AlterBase\StorePermissions;

class UserPermission
{
    protected $permissions = [
        'module' => [
            'name' => 'Users',
            'slug' => 'cms::users',
            'description' => 'Users Management',
            'icon_class' => 'fa-users'
        ],
        'actions' => [
            [
                'name' => 'View all users',
                'slug' => 'cms::users.index',
                'description' => 'Allow to view all users.',
                'view_on_sidebar' => true,
                'menu_name' => "All Users"
            ],
            [
                'name' => 'Create user',
                'slug' => 'cms::users.create',
                'description' => 'Allow to create new user.',
                'view_on_sidebar' => true,
                'menu_name' => "Add User"
            ],
            [
                'name' => 'Update user',
                'slug' => 'cms::users.update',
                'description' => 'Allow to update user.'
            ],
            [
                'name' => 'Delete user',
                'slug' => 'cms::users.delete',
                'description' => 'Allow to delete user.'
            ],
            [
                'name' => 'View all roles',
                'slug' => 'cms::users.roles.index',
                'description' => 'Allow to view all roles.',
                'view_on_sidebar' => true,
                'menu_name' => "All Roles"
            ],
            [
                'name' => 'Create role',
                'slug' => 'cms::users.roles.create',
                'description' => 'Allow to create new role.',
                'view_on_sidebar' => true,
                'menu_name' => "Add Role"
            ],
            [
                'name' => 'Update role',
                'slug' => 'cms::users.roles.update',
                'description' => 'Allow to update role.'
            ],
            [
                'name' => 'Delete role',
                'slug' => 'cms::users.roles.delete',
                'description' => 'Allow to delete role.'
            ],
            [
                'name' => 'Assign permission to role',
                'slug' => 'cms::users.roles.permissions',
                'description' => 'Allow to assign permissions to role.'
            ],
        ]
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