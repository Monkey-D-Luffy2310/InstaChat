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
        'title',
        'content',
        'user_id'
    ];

    /**
     * Get the post that owns the user
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
