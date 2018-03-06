<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ActorsFilms extends Model
{

    protected $fillable = [
        'film_id', 'actor_id','admin_id'
    ];





}
