<?php

$accessToken = 'EE0IU1xJpvjid+GHFQxZ5Hr/OGXXo+jH7fjpfQqeGCt7f8CJx4Q4xVmWRdXvGhul4SqIQZwSf138iAWoTyr4vdKu5ucbnQ1sxo9t1IiwOMfl5W9MjFw/W1IJgq8BGWLY6vRgRTWzinz8WGoVhZk1twdB04t89/1O/w1cDnyilFU=';
$jsonString = file_get_contents('php://input');
$jsonObj = json_decode($jsonString);
$message = $jsonObj->{"events"}[0]->{"message"}->{"text"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};
$return_message = $message . "じゃない♡";

$messageData = [
    'type' => 'text',
    'text' => $return_message
];

$response = [
    'replyToken' => $replyToken,
    'messages' => [$messageData]
];

error_log(json_encode($response));

$ch = curl_init('https://api.line.me/v2/bot/message/reply');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charser=UTF-8',
    'Authorization: Bearer ' . $accessToken
));
$result = curl_exec($ch);
error_log($result);
curl_close($ch);