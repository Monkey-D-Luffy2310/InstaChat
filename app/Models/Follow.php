<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'followed_user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function followed_user()
    {
        return $this->belongsTo('App\User');
    }
}
