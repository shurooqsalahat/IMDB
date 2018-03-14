<?php

namespace App\Policies;
use App\Users;
use Illuminate\Auth\Access\HandlesAuthorization;

class UsersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the users.
     *
     * @param  \App\Userss  $user
     * @param  \App\Users  $users
     * @return mixed
     */
    public function addToList(Users $user )
    {
       if($user->id > 0){
           return TRUE;
       }
       return FALSE;
    }



}