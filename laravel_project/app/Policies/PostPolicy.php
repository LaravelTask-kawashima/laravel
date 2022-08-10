<?php

namespace App\Policies;

use App\Models\User;
use App\Models\post;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->roles === "admin") {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, post $post)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, post $post)
    {

        foreach ($user->roles as $role) {
            if ($role->name == 'admin') {
                return true;
            }
        }

        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('あなたはこの投稿を編集できません。');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, post $post)
    {
        foreach ($user->roles as $role) {
            if ($role->name == 'admin') {
                return true;
            }
        }

        return $user->id === $post->user_id
            ? Response::allow()
            : Response::deny('あなたはこの投稿を削除できません。');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, post $post)
    {
        return $user->id === $post->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\post  $post
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, post $post)
    {
        return $user->id === $post->user_id;
    }
}
