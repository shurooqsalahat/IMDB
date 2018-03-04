<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class ActorsFilms extends Model
{

    protected $fillable = [
        'film_id', 'actor_id','admin_id'
    ];


    public  function store($admin_id , $films_id , $actors_id)
    {
        $this->film_id =$films_id;
        $this->actor_id =$actors_id;
        $this->admin_id =$admin_id;
        $this->save();
    }
}
