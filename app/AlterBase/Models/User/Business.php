<?php

namespace App\AlterBase\Models\User;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Business extends Authenticatable
{
  use Notifiable;

  protected $table = 'users';

  protected $guard = 'business';

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
   * 
   * @return string
   */
  public function setPasswordAttribute($password)
  {
    return $this->attributes['password'] = bcrypt($password);
  }

  /**
   * Users has one profile
   * 
   * @return Eloquent/HasOne
   */
  public function profile()
  {
    return $this->hasOne(Profile::class, 'user_id', 'id')->first();
  }
}
