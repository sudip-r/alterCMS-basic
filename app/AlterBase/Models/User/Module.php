<?php

namespace App\AlterBase\Models\User;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name','description','icon_class'];

    /**
     * Module has many permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    /**
     * Get menus for the module
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMenusAttribute()
    {
        return $this->permissions()->where('view_on_sidebar',true)->get(['id','slug','menu_name']);
    }
}
