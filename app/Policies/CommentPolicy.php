<?php

namespace App\Policies;

use App\User;
use App\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function create(User $user){
        if($user->can('create comments')){
            return true;
        }
    }

    public function update(User $user, Comment $comment){
        if($user->can('edit comment')){
            return $comment->user_id === $user->id;
        }
    }

    public function delete(User $user, Comment $comment){
        if($user->can('delete comment')){
            return $comment->user_id === $user->id;
        }   
    }
}
