<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListsUser extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    //
}
