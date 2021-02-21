<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => true,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAEiXDzBU:APA91bHwKSJe9iOiq6vEfM_XvkOCZ3mJV9OO4LSeFzpAOOxY3yz1erXxCRqN3phIJ4NyhjihB-JDkXZWM8EMYlwA2ij0Vp7yn_IFXtEDCrh-cavE88kxk9Hv2xLfzltNe-GNflYtFiD_'),
        'sender_id' => env('FCM_SENDER_ID', '77943000085'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
