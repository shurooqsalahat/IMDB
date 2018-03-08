<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmsMedia extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'admin_id', 'film_id', 'path',
    ];
    protected $dates = ['deleted_at'];




}
