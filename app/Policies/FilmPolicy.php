<?php

namespace App\Policies;
use App\Users;
use App\Films;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilmPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the films.
     *
     * @param  \App\Userss  $user
     * @param  \App\Films  $films
     * @return mixed
     */
    public function view(Users $user)
    {
        if($user->is_admin==1){
         return True;
        }
        return False;
    }

    /**
     * Determine whether the user can create films.
     *
     * @param  \App\Userss  $user
     * @return mixed
     */
    public function create(Users $user)
    {

        if($user->is_admin==1){
            return True;
        }
        return False;
    }

    /**
     * Determine whether the user can update the films.
     *
     * @param  \App\Userss  $user
     * @param  \App\Films  $films
     * @return mixed
     */
    public function update(Users $user, Films $films)
    {
        return ($user->id == $films->admin_id && $user->is_admin==1);
    }

    /**
     * Determine whether the user can delete the films.
     *
     * @param  \App\Userss  $user
     * @param  \App\Films  $films
     * @return mixed
     */
    public function delete(Users $user, Films $films)
    {
        return ($user->id == $films->admin_id && $user->is_admin==1);

    }
}
