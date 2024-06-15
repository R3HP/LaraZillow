<?php

namespace App\Http\Controllers;

use App\Notifications\OfferMadeNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class NotificationSeenController extends Controller
{
    public function __invoke(DatabaseNotification $notification)
    {
        $this->authorize('update',$notification);
        $notification->markAsRead();
        return redirect()->back()->with('success','Notification Read');
    }
}
