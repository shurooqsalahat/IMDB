<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    public function Actors()
    {
        return $this->belongsToMany('App\Actors','actors_films','film_id','actor_id');
    }
    public function Media()
    {
        return $this->hasMany('App\FilmsMedia','film_id');
    }

}
