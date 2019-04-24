<?php

namespace App\Policies;

use App\User;
use App\Delivery;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Delivery $delivery){
        if($user->can('view deliveries')){
            return $delivery->user_id === $user->id;
        }
    }

    public function create(User $user){
        if($user->can('create deliveries')){
            return true;
        }
    }

    public function update(User $user, Delivery $delivery){
        if($user->can('edit delivery')){
            return $delivery->user_id === $user->id;
        }
    }
}
