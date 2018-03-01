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

        DB::table('actors_films')->insert(
            ['admin_id' => $admin_id, 'film_id' =>$films_id,'actor_id' => $actors_id , 'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')]
        );

    }
}
