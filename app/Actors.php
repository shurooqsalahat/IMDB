<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actors extends Model
{
    protected $fillable = [
        'admin_id', 'name', 'information','image_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
