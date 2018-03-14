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
    public function actors()
    {
        return $this->belongsToMany(\App\Actors::class,'actors_films','film_id','actor_id')->withPivot('admin_id')
            ->withTimestamps();
    }
    public function lists()
    {
        return $this->belongsToMany(\App\Users::class,'lists_users','film_id','user_id')->withTimestamps();
    }
    public function media()
    {
        return $this->hasMany(\App\FilmsMedia::class,'film_id');
    }

}
