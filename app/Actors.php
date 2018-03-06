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
    public function Films()
    {
        return $this->belongsToMany('App\Films');
    }

    protected $dates = ['deleted_at'];
}
