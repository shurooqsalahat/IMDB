<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    protected $fillable = [
        'admin_id', 'name', 'summary',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

}
