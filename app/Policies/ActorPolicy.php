<?php

namespace App\Policies;

use App\Users;
use App\Actors;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the post.
     *
     * @param  \App\Userss  $user
     * @param  \App\Actors  $actor
     * @return mixed
     */
    public function view(Users $user, Actors $actor)
    {
        return TRUE;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\Userss  $user
     * @return mixed
     */
    public function create(Users $user)
    {
        return ( $user->is_admin==1);
    }

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Userss  $user
     * @param  \App\Actors  $actor
     * @return mixed
     */
    public function update(Users $user, Actors $actors)
    {
        return ($user->id == $actors->admin_id && $user->is_admin==1);
    }

    /**
     * Determine whether the user can delete the post.
     *
     * @param  \App\Userss  $user
     * @param  \App\Actors  $actor
     * @return mixed
     */
    public function delete(Users $user, Actors $actor)
    {
        return ($user->id == $actor->admin_id && $user->is_admin==1);

    }
}
