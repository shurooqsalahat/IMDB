<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Users extends Authenticatable
{

    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*check if user is admin or not
     * */
     public  function isAdmin(){
         if($this->is_admin){
             return true;
         }
         return false;
     }

    public function lists()
    {
        return $this->hasMany('App\ListsUser','user_id');
    }

}