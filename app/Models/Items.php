<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'is_trash'
    ];

    /**
     * Get the requests.
     */
    public function requests()
    {
        return $this->hasMany('App\Models\Requests');
    }
}
