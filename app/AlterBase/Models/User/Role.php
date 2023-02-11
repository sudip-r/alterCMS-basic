<?php

namespace App\AlterBase\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    protected $table  = 'roles';

    protected $fillable = ['name','description'];

    /**
     * Role has many permissions
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'role_permission');
    }

    /**
     * Check if role has given permission
     *
     * @param Permission $permission
     * @return bool
     */
    public function hasPermission(Permission $permission)
    {
        return DB::table('role_permission')->where(['role_id' => $this->id,'permission_id' => $permission->id])->exists();
    }

    /**
     * Role has many modules
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function modules()
    {
        return $this->belongsToMany(Module::class,'role_module');
    }

    /**
     * Check if role has given module
     *
     * @param Module $module
     * @return bool
     */
    public function hasModule(Module $module)
    {
        return DB::table('role_module')->where(['role_id'=>$this->id,'module_id'=>$module->id])->exists();
    }
}
