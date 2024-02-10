<?php
namespace App\Http\Traits;

use App\Models\User;
use App\Models\Notification;

trait NotificationTrait{

    public function sendNotification(String $title,String $body,$itemId, string $itemType)
    {
        // $url = 'https://fcm.googleapis.com/fcm/send';

        // $FcmToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        // $serverKey = '';

        // $data = [
        //     "registration_ids" => $FcmToken,
        //     "notification" => [
        //         "title" => $title,
        //         "body" => $body,
        //         "item_id" => $itemId,
        //         "item_type" => $itemType,
        //     ]
        // ];

        $notification = Notification::create([
            "title"   => $title,
            "body"    => $body,
            "item_id" => $itemId,
            "item_type" => $itemType,
        ]);

        // $encodedData = json_encode($data);

        // $headers = [
        //     'Authorization:key=' . $serverKey,
        //     'Content-Type: application/json',
        // ];

        // $ch = curl_init();

        // curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        // curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // // Disabling SSL Certificate support temporarly
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // // Execute post
        // $result = curl_exec($ch);
        // if ($result === FALSE) {
        //     die('Curl failed: ' . curl_error($ch));
        // }
        // // Close connection
        // curl_close($ch);
        // // FCM response
        // return $result;
    }





}
