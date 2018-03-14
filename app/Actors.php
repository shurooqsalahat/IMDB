<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actors extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'admin_id', 'name', 'information','image_path',
    ];
    public function films()
    {
        return $this->belongsToMany(\App\Films::class,'actors_films','film_id','actor_id')->withPivot('admin_id')
            ->withTimestamps();
    }

    protected $dates = ['deleted_at'];
}
