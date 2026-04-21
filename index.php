<?php
$token = "8693233767:AAHHXPWFYmyPNIw0RvVsywOXV3ydnqqFtKM";

function bot($method, $data = []) {
    global $token;
    $url = "https://api.telegram.org/bot$token/$method";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $res = curl_exec($ch);
    curl_close($ch);
    return json_decode($res, true);
}

$update = json_decode(file_get_contents("php://input"), true);

if (isset($update["message"])) {
    $chat_id = $update["message"]["chat"]["id"];
    $text = $update["message"]["text"];

    if ($text == "/start") {
        bot("sendMessage", [
            "chat_id" => $chat_id,
            "text" => "✅ البوت يعمل بنجاح على Render!"
        ]);
    }
}
