<?php

namespace App\AlterBase\Models\User;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $table  = 'user_profile';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'user_id',
    'name',
    'address',
    'contact',
    'contact_person',
    'mobile',
    'cover_image',
    'description',
    'summary',
    'categories',
    'map'
  ];
}
