<?php

namespace App\AlterBase\Permissions;

use App\AlterBase\StorePermissions;

class MessagePermission
{
    protected $permissions = [
        'module' => [
            'name' => 'My Messages',
            'slug' => 'cms::messages',
            'description' => 'Messages',
            'icon_class' => 'fa-comment-alt',
        ],
        'actions' => [
            [
                'name' => 'View Messages',
                'slug' => 'cms::messages.message',
                'description' => 'Allow users to view messages',
                'view_on_sidebar' => true,
                'menu_name' => "Messages",
            ],
            [
                'name' => 'Send Message',
                'slug' => 'cms::messages.message.send',
                'description' => 'Allow users to send messages',
                'view_on_sidebar' => false,
                'menu_name' => "Send Message",
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
