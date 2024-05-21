<?php

namespace App\sqs;

use Aws\Credentials\Credentials;
use Aws\Sns\SnsClient;

class SnsDispatchNotification {
    public static function notify($message): \Aws\Result
    {
        dd($message);
        $client = new SnsClient([
            'region' => env('REGION_AWS'),
            'credentials' => new Credentials(
                env('AWS_ACCESS_KEY_ID'),
                env('AWS_SECRET_ACCESS_KEY')
            ),
        ]);

        $result = $client->publish([
            'TargetArn' => env('NOTIFICATION_QUEUE'),
            'Message' => json_encode(['default' => json_encode($message)]),
            'MessageStructure' => 'json',
            'MessageAttributes' => [
                'Content-Type' => [
                    'DataType' => 'String',
                    'StringValue' => 'application/json',
                ],
            ]
        ]);

        return $result;
    }
}
