<?php

namespace App\AlterBase\Models\User;

use App\AlterBase\Models\Setting\Message;
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

  protected $appends = ['image'];

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

  /**
   * Get user profile
   * 
   * @return Collection
   */
  public function profile()
  {
    return $this->from('users as u')
                ->join('user_profile as p', 'p.user_id', 'u.id')
                ->where('u.id', $this->id)
                ->select(['p.name', 'p.address', 'p.contact'])
                ->get()
                ->first();
  }

  /**
   * Get user setting
   * 
   * @return \Illuminate\Database\Eloquent\Relations\HasOne
   */
  public function setting()
  {
    return $this->hasOne(UserSetting::class, 'user_id', 'id');
  }

  /**
   * User has many messages
   * 
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function inbox()
  {
    return $this->hasMany(Message::class, 'user_id');
  }

  /**
   * Get user profile image
   * 
   * @return String
   */
  public function getImageAttribute()
  {
    if($this->profile_image == "user.png")
      return mpath('cms/dist/img/user.png');

    return mpath('uploads/users/'.$this->profile_image);
  }



}
