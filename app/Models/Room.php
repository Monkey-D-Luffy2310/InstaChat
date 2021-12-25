<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get the room for the user is owner
     */
    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    /**
     * Get the room for the user is owner
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
