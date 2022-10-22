<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function markread($id){
        $user = Auth::user();
        $user->unreadNotifications->where('id', $id)->markAsRead();
        return back()->with('success', 'Notification marked as read!');
    }

    public function markallread(){
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();

        return back()->with('success', 'All Notifications are marked as read!');
    }
}
