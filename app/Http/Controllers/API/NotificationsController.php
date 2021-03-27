<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

abstract class NotificationsController extends Controller
{
    public function getUnreadNotifications($userId) {
        $user = $this->getUserObjectFromId($userId);

        return response()->json([
            "message" => "Fetched user unread notifications",
            "status" => "Success",
            "details" => [
                "notifications" => $user->unreadNotifications
            ]
        ]);
    }

    public function getReadNotifications($userId) {
        $user = $this->getUserObjectFromId($userId);

        return response()->json([
            "message" => "Fetched user read notifications",
            "status" => "Success",
            "details" => [
                "notifications" => $user->readNotifications
            ]
        ]);
    }

    public function markNotificationsRead($userId) {
        $user = $this->getUserObjectFromId($userId);

        $user->unreadNotifications->markAsRead();

        return response()->json([
            "message" => "Marked notifications as read",
            "status" => "Success",
        ]);
    }

    public function markNotificationRead($notificationId){
        // TODO: TBD
        return response()->json([
            "message" => "Not implemented",
            "status" => "Failed"
        ]);
    }

    abstract function getUserObjectFromId($userId);
}
