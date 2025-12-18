<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function notifications()
    {
        $notifications = Auth::user()->notifications;

        return view('kaprodi.notif', compact('notifications'));
    }

}
