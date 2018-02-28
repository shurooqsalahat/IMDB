<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilmsActors extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'films_id', 'actor_id', 'admin_id',
    ];
    protected $dates = ['deleted_at'];
}
