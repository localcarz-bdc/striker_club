<?php
namespace App\Traits;

use App\Models\Notification;


trait Notify
{
    public function saveNewNotification($title, $message, $admin_call_back_url, $member_call_back_url, $to_user, $category)
    {
        $date_time_now = now();
        // $category = 'non-communication';
        $new_notification = Notification::create([
            'category' => $category,
            'title' => $title,
            'message' => $message,
            'member_call_back_url' => $member_call_back_url,
            'admin_call_back_url' => $admin_call_back_url,
            'user_id' => $to_user,
        ]);

        $new_notification->save();

        return $new_notification->id;
    }
}
