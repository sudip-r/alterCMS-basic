<?php

namespace App\AlterBase;


use App\AlterBase\Models\User\Module;
use App\AlterBase\Models\User\Permission;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Schema;

class StorePermissions extends Facade
{
    /**
     * Add given permissions if already does not exist
     *
     * @param $permissions
     */
    public static function add($permissions)
    {

        if(self::tablesExist()){
            $module = self::findOrCreateGroup($permissions['module']);

            foreach($permissions['actions'] as $permission){
                if(self::permissionDoesNotExist($permission)){
                    $permission['module_id'] = $module->id;
                    Permission::create($permission);
                }

            }
        }
    }

    /**
     * Check if given permission already exist or not
     *
     * @param $permission
     * @return bool
     */
    private static function permissionDoesNotExist($permission)
    {
        return ! Permission::where('slug',$permission['slug'])->exists();

    }

    /**
     * Check if permission groups and permissions table exist
     *
     * @return bool
     */
    private static function tablesExist()
    {
        return Schema::hasTable('modules') && Schema::hasTable('permissions');
    }

    /**
     * Find or create group
     *
     * @param $module
     * @return Model
     */
    private static function findOrCreateGroup($module)
    {
        $mod = Module::where('slug', $module['slug'])->first();

        if(!$mod){
            return Module::create($module);
        }

        return $mod;
    }
}