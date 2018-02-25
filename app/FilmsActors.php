<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmsActors extends Model
{
    protected $fillable = [
        'films_id', 'actor_id', 'admin_id',
    ];
}
