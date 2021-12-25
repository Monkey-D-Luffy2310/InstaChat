<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'message',
        'room_id',
        'user_id'
    ];

    /**
     * Get the message that owns the user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the message that owns the room
     */
    public function room()
    {
        return $this->belongsTo('App\Model\Room');
    }
}
