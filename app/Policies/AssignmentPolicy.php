<?php

namespace App\Policies;

use App\User;
use App\Assignment;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Assignment $assignment){
        if($user->can('view assignments')){
            return true;
        }
    }

    public function create(User $user){
        if($user->can('create assignments')){
            return true;
        }
    }

    public function update(User $user){
        if($user->can('edit assignment')){
            return true;
        }
    }

    public function delete(User $user){
        if($user->can('delete assignment')){
            return true;
        }   
    }
}
