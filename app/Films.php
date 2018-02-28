<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Films extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'admin_id', 'name', 'summary',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}
