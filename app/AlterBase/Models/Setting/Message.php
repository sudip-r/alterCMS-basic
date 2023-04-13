<?php

namespace App\AlterBase\Models\Setting;

use App\AlterBase\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'user_id',
        'message_from',
        'message_to',
        'message',
        'task',
        'status',
        'starred',
    ];

    /**
     * Sender belongs to User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BlongsTo
     */
    public function sent()
    {
        return $this->belongsTo(User::class, 'message_to', 'id');
    }

    /**
     * Receiver belongs to User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BlongsTo
     */
    public function received()
    {
        return $this->belongsTo(User::class, 'message_from', 'id');
    }

}
