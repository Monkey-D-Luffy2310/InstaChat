<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'photoURL',
        'user_id'
    ];

    /**
     * Get the post that owns the user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the likes for the post
     */
    public function likes()
    {
        return $this->hasMany('App\Models\LikedPost')->with('user');
    }

    /**
    * Get the likes for the post
    */
    public function comments() {
        return $this->hasMany('App\Models\Comment')->with('user');
    }
}
