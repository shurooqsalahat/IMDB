<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListsUser extends Model
{

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function Films()
    {
        return $this->hasMany(\App\Films::class,'id');
    }
}
