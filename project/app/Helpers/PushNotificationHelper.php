<?php
namespace App\Helpers;

use GuzzleHttp\Client;

class PushNotificationHelper
{
    public static function sendPushNotification($title, $body, $image = null, $link = null, $deviceToken)
    {

        // Replace with your FCM server key
        $serverKey = 'AAAAGNRJXfE:APA91bED66fdaGkHMmRDHJW3Lu2tPbQ2CKAyciNXelej7x_UaZhXPohoCLut3Hfq9e-OQQ9tiDzBqlb3zJrtJVUHQXaqUFTU43ek9ZPfPHZWC8SqZT-JfpGCY8_4OwdYFW0sMpO3UO0Q';

        // Firebase FCM endpoint
        $fcmEndpoint = 'https://fcm.googleapis.com/fcm/send';

        // Prepare the payload
        $payload = [
            'notification' => [
                'title' => $title,
                'body' => $body,
                'sound' => 'default',
                'image' => $image,
                'link' => $link,
            ],
            'to' => $deviceToken,
        ];

        // Send push notification via FCM
        $client = new Client();
        $response = $client->request('POST', $fcmEndpoint, [
            'headers' => [
                'Authorization' => 'key=' . $serverKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $payload,
        ]);

        // Process the response
        $statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();

        return [
            'status_code' => $statusCode,
            'body' => json_decode($body),
        ];
    }
}
