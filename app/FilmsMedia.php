<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FilmsMedia extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'admin_id', 'film_id', 'path',
    ];
    protected $dates = ['deleted_at'];

    public  function store($admin_id , $films_id,$path)
    {
        /*$this->admin_id =$admin_id;
        $this->film_id =$films_id;
        $this->path =$path;
        $this->save();*/
        DB::table('films_media')->insert(
            ['admin_id' => $admin_id , 'film_id' =>$films_id,'path' =>$path , 'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')]
        );

    }


}
