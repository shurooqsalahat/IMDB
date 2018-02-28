<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActorsFilms extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
}
