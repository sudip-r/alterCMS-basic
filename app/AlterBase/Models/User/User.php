<?php

namespace App\AlterBase\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'verified',
    'active',
    'guard',
    'user_type',
    'last_login',
    'online',
    'profile_image',
    'verification_token',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  /**
   * @param $password
   * @return string
   */
  public function setPasswordAttribute($password)
  {
    return $this->attributes['password'] = bcrypt($password);
  }

  /**
   * Return true if user has given role
   *
   * @param $role
   * @return bool
   */
  public function hasRole($role, $name = "")
  {
    $role = !is_string($role) ?: app(Role::class)->where(['name' => $name])->firstOrFail();

    if ($role) {
      foreach ($this->roles as $r) {
        if ($r->id == $role->id) {
          return true;
        }
      }
    }
    return false;
  }

  /**
   * @param $slug
   * @return bool
   */
  public function hasPermission($slug)
  {
    $permission = !is_string($slug) ?: app(Permission::class)->where(['slug' => $slug])->first();

    if ($permission) {
      foreach ($this->roles as $role) {
        if ($role->hasPermission($permission)) {
          return true;
        }
      }
    }
    return false;
  }

  /**
   * Check if the user is super admin
   *
   * @return bool
   */
  public function isSuperuser()
  {
    return in_array($this->email, config('auth.superusers'));
  }

  /**
   * User has many roles
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function roles()
  {
    return $this->belongsToMany(Role::class, 'user_role');
  }
}
