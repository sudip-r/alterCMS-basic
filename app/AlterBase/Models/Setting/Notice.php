<?php

namespace App\AlterBase\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table  = 'notices';

    protected $fillable = [
        'user_id',
        'notice',
        'status'
    ];

}