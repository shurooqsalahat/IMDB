<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmsMedia extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'admin_id', 'films_id', 'path',
    ];
    protected $dates = ['deleted_at'];
}
