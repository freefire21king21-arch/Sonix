<?php
$API_KEY = '8693233767:AAHHXPWFYmyPNIw0RvVsywOXV3ydnqqFtKM';
define('API_KEY', $API_KEY);

function bot($method, $datas = []) {
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method;
    if (!empty($datas)) {
        $url .= "?" . http_build_query($datas);
    }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response, true);
}

$update = json_decode(file_get_contents('php://input'), true);
if (!$update) {
    exit;
}

if (isset($update['message'])) {
    $chat_id = $update['message']['chat']['id'];
    $text = $update['message']['text'] ?? '';

    if ($text === '/start') {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "مرحباً! البوت يعمل الآن على Render بنجاح 🚀"
        ]);
    }
}
