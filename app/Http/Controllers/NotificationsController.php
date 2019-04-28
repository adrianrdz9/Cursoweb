<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function show($id){
        foreach (auth()->user()->notifications as $notification) {
            if($notification->id == $id){
                $notification->markAsRead();
                return redirect($notification->data['link_to']);
            }
        }

        return redirect()->back();
    }
}
