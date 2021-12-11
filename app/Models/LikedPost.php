<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LikedPost extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable= [
        'user_id', 'post_id'
    ];

    /**
     * Get the like that owns the user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

     /**
     * Get the like that owns the post
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
