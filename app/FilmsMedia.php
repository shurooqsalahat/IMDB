<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmsMedia extends Model
{
    protected $fillable = [
        'admin_id', 'films_id', 'path',
    ];
}
