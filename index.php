<?php

// By @QGQFQ - تم التعديل والتصحيح النهائي لـ Render

ob_start();

// إنشاء المجلدات الأساسية
$folders = ['data', 'EMIL', 'EMILS', 'BUY', 'assignment', 'data/id', 'data/txt', 'data/api'];
foreach ($folders as $folder) {
    if (!is_dir($folder)) mkdir($folder, 0777, true);
}

$API_KEY = '8693233767:AAHHXPWFYmyPNIw0RvVsywOXV3ydnqqFtKM';
define('API_KEY', $API_KEY);

function bot($method, $datas = []) {
    $amrakl = http_build_query($datas);
    $url = "https://api.telegram.org/bot" . API_KEY . "/" . $method . "?" . $amrakl;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $amrakl = curl_exec($ch);
    curl_close($ch);
    return json_decode($amrakl);
}

$update = json_decode(file_get_contents('php://input'));

if (!$update) {
    exit;
}

$message = $update->message ?? null;
$callback_query = $update->callback_query ?? null;

if ($callback_query) {
    $chat_id = $callback_query->message->chat->id;
    $message_id = $callback_query->message->message_id;
    $data = $callback_query->data;
    $user = $callback_query->from->username;
    $first = $callback_query->from->first_name;
    $id = $callback_query->from->id;
} elseif ($message) {
    $chat_id = $message->chat->id;
    $text = $message->text;
    $message_id = $message->message_id;
    $user = $message->from->username;
    $first = $message->from->first_name;
    $id = $message->from->id;
} else {
    exit;
}

if (isset($update->callback_query)) {
    $chat_id = $update->callback_query->message->chat->id;
    $message_id = $update->callback_query->message->message_id;
    $data = $update->callback_query->data;
    $user = $update->callback_query->from->username;
    $first = $update->callback_query->from->first_name;
}

#=========={التخزينات}==========#
function Aemil($array) {
    file_put_contents('EMIL/emil.json', json_encode($array));
}
function Bemil($array) {
    file_put_contents('EMIL/emils.json', json_encode($array));
}
function Now($array) {
    file_put_contents('EMIL/emilnow.json', json_encode($array));
}
function OrdAll($array) {
    file_put_contents('BUY/Orderall.json', json_encode($array, 64 | 128 | 256));
}
function NumbBuys($array, $account) {
    file_put_contents("EMILS/$account/number.json", json_encode($array, 64 | 128 | 256));
}
function SendBuys($array, $account) {
    file_put_contents("EMILS/$account/send.json", json_encode($array, 64 | 128 | 256));
}
function CardBuys($array, $account) {
    file_put_contents("EMILS/$account/card.json", json_encode($array, 64 | 128 | 256));
}
function PricBuys($array, $account) {
    file_put_contents("EMILS/$account/price.json", json_encode($array, 64 | 128 | 256));
}
function Ands($array) {
    file_put_contents('data/openlock.json', json_encode($array));
}
function Bnds($array) {
    file_put_contents('data/addblusdel.json', json_encode($array));
}
function Agent($array) {
    file_put_contents('data/txt/agent.json', json_encode($array));
}
function Addserver($array) {
    file_put_contents('data/country.json', json_encode($array, 64 | 128 | 256));
}
function Sool($array) {
    file_put_contents('data/txt/sool.json', json_encode($array));
}
function Ready($array) {
    file_put_contents('data/storenumber.json', json_encode($array));
}
function Admins($array) {
    file_put_contents('data/id/admin.json', json_encode($array));
}
function Save($array) {
    file_put_contents('data/txt/random.json', json_encode($array));
}
function Ssai($array) {
    file_put_contents("assignment/addem.json", json_encode($array));
}
function Dsai($array) {
    file_put_contents("assignment/addid.json", json_encode($array));
}
function Apps($array) {
    file_put_contents('data/api/apps.json', json_encode($array, 64 | 128 | 256));
}
$zzz = json_decode(file_get_contents("zzz.json"), 1);
function zzz() {
    global $zzz;
    file_put_contents("zzz.json", json_encode($zzz));
}
$EMIL = json_decode(file_get_contents('EMIL/emil.json'), true);
$EMILS = json_decode(file_get_contents('EMIL/emils.json'), true);
$EMILNow = json_decode(file_get_contents('EMIL/emilnow.json'), true);
$ORDERALL = json_decode(file_get_contents('BUY/Orderall.json'), true);
$openandlock = json_decode(file_get_contents('data/openlock.json'), true);
$addblusdel = json_decode(file_get_contents('data/addblusdel.json'), true);
$agents = json_decode(file_get_contents('data/txt/agent.json'), true);
$buy = json_decode(file_get_contents('data/country.json'), true);
$sool = json_decode(file_get_contents('data/txt/sool.json'), true);
$storenumber = json_decode(file_get_contents('data/storenumber.json'), true);
$admins = json_decode(file_get_contents('data/id/admin.json'), true);
$random = json_decode(file_get_contents('data/txt/random.json'), true);
$assignment = json_decode(file_get_contents('assignment/addem.json'), true);
$assignment2 = json_decode(file_get_contents('assignment/addid.json'), true);
$APPS = json_decode(file_get_contents('data/api/apps.json'), true);

#============={أوامر إضافية}===========#
$me = bot('getme', ['bot'])->result->username;
$bot = "NUMBER22_1";
$get = file_get_contents('data/txt/file.txt');
$exxx = explode("\n", $get);
$count = count($exxx);
if ($user != null) {
    $User_link = "☑️ - رابط العضو ↖️";
}

#=========={حساب الإحصائيات}=========#
$numbot = $ORDERALL['number'] ?? 0;
$readybot = $ORDERALL['ready'] ?? 0;
$numbots = count($ORDERALL);
$numbote = $numbots - $numbot;
$buysall = $numbots;
$Buybot = $numbot + $readybot;
$cardbot = $ORDERALL['card'] ?? 0;
$sendbot = $ORDERALL['send'] ?? 0;
$money2 = file_get_contents("data/txt/rubleall.txt") ?: 0;
$poi_money = file_get_contents("data/txt/pointall.txt") ?: 0;
$money = $money2 - $poi_money;
$allcharges = $ORDERALL['add'] ?? 0;
$assignru = 0.25;
$Exchange = 60;

#________________
$EM = $EMILNow['emil'][$chat_id];
$passewo = $EMILNow['password'][$chat_id];
if ($EM == null) {
    $EM = $EMIL[$chat_id]['emil'];
    $passewo = $EMIL[$chat_id]['pass'];
}
$perrewo = $EMILS['emils'][$EM]['pass'];
if (!is_dir("EMILS/$EM")) {
    mkdir("EMILS/$EM");
}
if (!is_dir("data/id/$id")) {
    mkdir("data/id/$id");
}
$BUYSNUM = json_decode(file_get_contents("EMILS/$EM/number.json"), true);
$BUYSSEND = json_decode(file_get_contents("EMILS/$EM/send.json"), true);
$BUYSCARD = json_decode(file_get_contents("EMILS/$EM/card.json"), true);
$BUYSPRIC = json_decode(file_get_contents("EMILS/$EM/price.json"), true);

#_________________
$Detector = file_get_contents("data/id/$id/restriction.txt");
$step = file_get_contents("data/id/$id/step.txt");
$twas = file_get_contents("data/id/$id/twas.txt");
$buynumber = file_get_contents("data/id/$id/number.txt");
$exstep = explode("|", $step);
$extext = explode("\n", $text);
$ex_text = explode(" ", $text);
$ex__text = explode("-", $text);
$exdata = explode("-", $data);
$ex_data = explode("#", $data);
$ordermy = count($BUYSNUM['number']);
$numbuy = $BUYSNUM['number_my'] ?? 0;
$readymy = $BUYSNUM['ready_my'] ?? 0;
$orderall = count($ORDERALL) + 1;
$idnums = count($ORDERALL) + 999999999;
$cardmy = count($BUYSCARD);
$sendmy = count($BUYSSEND);
$pricmy = count($BUYSPRIC);
$buymy = $BUYSNUM['number_my'] ?? 0;
$rubles = file_get_contents("EMILS/$EM/rubles.txt") ?: 0;
$Balance = file_get_contents("EMILS/$EM/points.txt") ?: 0;
$consumers = $rubles - $Balance;

#_________________
date_default_timezone_set('Asia/Baghdad');
$tim = date('h' . 'i' . 's');
$tim1 = date('h:i:s');
$aa = date('a');
$a = str_replace(["am", "pm"], ["AM", "PM"], $aa);
$e = str_replace(["am", "pm"], ["صباحاً", "مسائاً"], $aa);
$time = "$tim$a";
$D = date('j');
$Y = date('Y');
$M = date('n');
if ($M < 10) $M = "0$M";
if ($D < 10) $D = "0$D";
function day_name() {
    $ds = ['الأحد', 'الأثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
    return $ds[Date('w')];
}
$DY = day_name();
function month_name() {
    $month_n = ['فارغ','يناير','فبراير','مارس','ابريل','مايو','يونيو','يوليو','اغسطس','سبتمبر','اكتوبر','نوفمبر','ديسمبر'];
    return $month_n[date('n')];
}
$MH = month_name();
$DAY = "$Y$M$D$time";
$DAY2 = "$DY $D $MH $Y | $tim1 $e";
$DAY3 = "$D-$M-$Y | $tim1 $e";

#_________________
$chall = "TZZQX";
$useradmin = "TITTZI";
$sim = -1001913573510;
$PAY = -1001634464532;
$ess = -1001928637976;
$eer = -1001810340779;
if ($chat_id == 7983624135) {
    $sudo = $chat_id;
} else {
    $sudo = 7983624135;
}

#=========={الإشتراك الإجباري}==========#
if (!in_array($id, $exxx) and $ex_text[1] != null) {
    $cod = $ex_text[1];
    $EEM = $assignment["emils"][$cod];
    if ($assignment2['my'][$id] == null and $EMILS['emils'][$EEM]['emil'] != null and $EEM != $EM) {
        file_put_contents("data/id/$id/lift.txt", "$EEM");
    }
}
$status = bot('getChatMember', ['chat_id' => $sim, 'user_id' => $chat_id])->result->status;
if ($data == "verification") {
    if ($status == 'left') {
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "🚧︙يرجى الإنضمام بالقناة أولاً، ثم إضغط على التحقق.",
            'show_alert' => true
        ]);
        exit;
    }
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "☑️*︙تم التحقق من الإنضمام وشكرا لإنضمامك* 😁",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "- للدخول إلى البوت إضغط هنا ☑️", 'callback_data' => "startup"]]
            ]
        ])
    ]);
    exit;
}
if ($data == null and $status == 'left') {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
🖐*︙مرحبا* [$first](tg://user?id=$id) .♥️

- يجب الإشتراك بقناة البوت الرسمية لإستخدام البوت 📢

*- رابط القناة: @QGQFQ @$chall*

🙋‍♂️ *⁞ إضغط على الزر بالأسفل للتحقق.*
",
        'reply_to_message_id' => $message_id,
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "التحقق من الإنضمام. ☑️", 'callback_data' => "verification"]]
            ]
        ])
    ]);
    exit;
}
if ($data != null and $status == 'left') {
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
🖐*︙مرحبا* [$first](tg://user?id=$id) .♥️

- يجب الإشتراك بقناة البوت الرسمية لإستخدام البوت 📢

*- رابط القناة: $ch_sub*

🙋‍♂️ *⁞ إضغط على الزر بالأسفل للتحقق.*
",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "التحقق من الإنضمام. ☑️", 'callback_data' => "verification"]]
            ]
        ])
    ]);
    exit;
}

#=========={قفل البوت}==========#
if ($openandlock['bot']['lock'] == "ok" and $id != $sudo) {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
*البوت تحت الصيانة حاليا , سوف يتم إشعاركم في قناة البوت عند الإكتمال , ونشكر انتظاركم 💙🙂*
",
        'reply_to_message_id' => $message_id,
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "⚜ قناة البوت ⚜", 'url' => "t.me/$chall"]]
            ]
        ])
    ]);
    exit;
}

#=========={رسالة /start}==========#
$liftchal = file_get_contents("data/id/$id/lift.txt");
if ($liftchal != null and $assignment2['my'][$id] == null and $EMILS['emils'][$liftchal]['emil'] != null and $liftchal != $EM) {
    $EMID = $EMILS['emils'][$liftchal]['id'];
    bot('sendMessage', [
        'chat_id' => $EMID,
        'text' => "
☑️* - قام عضو جديد بستجيل الدخول عبر رابطك
💸 - وتم إضافة $assignru روبل لحسابك بنجاح*
",
        'parse_mode' => "MarkDown",
    ]);
    $assignment2['my'][$id] = $liftchal;
    Dsai($assignment2);
    $points = file_get_contents("EMILS/$liftchal/points.txt");
    $as = $points + $assignru;
    file_put_contents("EMILS/$liftchal/points.txt", $as);
    $rubles = file_get_contents("EMILS/$liftchal/rubles.txt");
    $ds = $rubles - $assignru;
    file_put_contents("EMILS/$liftchal/rubles.txt", $ds);
    $pointall = file_get_contents("data/txt/pointall.txt");
    $alls = $pointall + $assignru;
    file_put_contents("data/txt/pointall.txt", $alls);
    $rubleall = file_get_contents("data/txt/rubleall.txt");
    $dlls = $rubleall + $assignru;
    file_put_contents("data/txt/rubleall.txt", $dlls);
    unlink("data/id/$id/lift.txt");
}
if ($ex_text[0] == '/start' and $ex_text[1] != 'ONE' and $id !== $sudo) {
    $cod = $ex_text[1];
    $EEM = $assignment["emils"][$cod];
    $EMID = $EMILS['emils'][$EEM]['id'];
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
♐️ - مرحبا بك [$first](tg://user?id=$id) ؛ 🤍

*- في بوت @QGQFQ* ؛ البوت الأفضل على التليجرام والذي يقوم بتوفير *خدمات الأرقام الوهمية* ل مواقع السوشيال ميديا مثل *التيليجرام والواتساب والتويتر وغيره* 👾

*- قم بإنشاء حساب جديد* ؛ واذا كان لديك حساب من قبل: قم بالضغط على زر *تسجيل الدخول* ☑️
",
        'parse_mode' => "MarkDown",
        'disable_web_page_preview' => true,
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => 'لديكَ حساب؟ تسجيل دخول 📲', 'callback_data' => "login"]],
                [['text' => 'إنشاء حساب جديد ☑️', 'callback_data' => "sign_in"]],
                [['text' => 'شروط الإستخدام وإخلاء للمسؤلية 🚨', 'callback_data' => "to_explain"]],
                [["text" => 'إدارة البوت 👨🏻‍💻', "url" => "tg://user?id=$sudo"]],
                [['text' => 'هام للأعضاء الجُدد ⚠️', 'callback_data' => "Important"]],
                [['text' => 'إحصائيات المستخدمين 📈', 'callback_data' => 'statsbot2']]
            ]
        ])
    ]);
    if (!in_array($id, $exxx) and $assignment2['my'][$id] == null and $cod != null and $EMILS['emils'][$EEM]['emil'] != null and $EEM != $EM) {
        bot('sendMessage', [
            'chat_id' => $EMID,
            'text' => "
☑️* - قام عضو جديد بستجيل الدخول عبر رابطك
💸 - وتم إضافة $assignru روبل لحسابك بنجاح*
",
            'parse_mode' => "MarkDown",
        ]);
        $assignment2['my'][$id] = $EEM;
        Dsai($assignment2);
        $points = file_get_contents("EMILS/$EEM/points.txt");
        $as = $points + $assignru;
        file_put_contents("EMILS/$EEM/points.txt", $as);
        $rubles = file_get_contents("EMILS/$EEM/rubles.txt");
        $ds = $rubles - $assignru;
        file_put_contents("EMILS/$EEM/rubles.txt", $ds);
        $pointall = file_get_contents("data/txt/pointall.txt");
        $alls = $pointall + $assignru;
        file_put_contents("data/txt/pointall.txt", $alls);
        $rubleall = file_get_contents("data/txt/rubleall.txt");
        $dlls = $rubleall + $assignru;
        file_put_contents("data/txt/rubleall.txt", $dlls);
    }
    if (!in_array($id, $exxx)) {
        file_put_contents('data/txt/file.txt', "\n" . $id, FILE_APPEND);
    }
    unlink("data/id/$id/step.txt");
    exit;
}

#=========={للمطور}==========#
if ($text == '/my' and $id == $sudo) {
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
♐️ - مرحبا بك [$first](tg://user?id=$id) ؛ 🤍

*- في بوت @QGQFQ* ؛ البوت الأفضل على التليجرام والذي يقوم بتوفير *خدمات الأرقام الوهمية* ل مواقع السوشيال ميديا مثل *التيليجرام والواتساب والتويتر وغيره* 👾

*- قم بإنشاء حساب جديد* ؛ واذا كان لديك حساب من قبل: قم بالضغط على زر *تسجيل الدخول* ☑️
",
        'parse_mode' => "MarkDown",
        'disable_web_page_preview' => true,
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => 'لديكَ حساب؟ تسجيل دخول 📲', 'callback_data' => "login"]],
                [['text' => 'إنشاء حساب جديد ☑️', 'callback_data' => "sign_in"]],
                [['text' => 'شروط الإستخدام وإخلاء للمسؤلية 🚨', 'callback_data' => "to_explain"]],
                [["text" => 'إدارة البوت 👨🏻‍💻', "url" => "tg://user?id=$sudo"]],
                [['text' => 'هام للأعضاء الجُدد ⚠️', 'callback_data' => "Important"]],
                [['text' => 'إحصائيات المستخدمين 📈', 'callback_data' => 'statsbot2']]
            ]
        ])
    ]);
    unlink("data/id/$id/step.txt");
    exit;
}

#=========={لوحة التحكم}==========#
if ($data == "startup") {
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
♐️ - مرحبا بك [$first](tg://user?id=$id) ؛ 🤍

*- في بوت @QGQFQ* ؛ البوت الأفضل على التليجرام والذي يقوم بتوفير *خدمات الأرقام الوهمية* ل مواقع السوشيال ميديا مثل *التيليجرام والواتساب والتويتر وغيره* 👾

*- قم بإنشاء حساب جديد* ؛ واذا كان لديك حساب من قبل: قم بالضغط على زر *تسجيل الدخول* ☑️
",
        'parse_mode' => "MarkDown",
        'disable_web_page_preview' => true,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => 'لديكَ حساب؟ تسجيل دخول 📲', 'callback_data' => "login"]],
                [['text' => 'إنشاء حساب جديد ☑️', 'callback_data' => "sign_in"]],
                [['text' => 'شروط الإستخدام وإخلاء للمسؤلية 🚨', 'callback_data' => "to_explain"]],
                [["text" => 'إدارة البوت 👨🏻‍💻', "url" => "tg://user?id=$sudo"]],
                [['text' => 'هام للأعضاء الجُدد ⚠️', 'callback_data' => "Important"]],
                [['text' => 'إحصائيات المستخدمين 📈', 'callback_data' => 'statsbot2']]
            ]
        ])
    ]);
    unlink("data/id/$id/step.txt");
    exit;
}

#=========={الحماية}==========#
if ($Detector != null) {
    if ($exdata[0] == "Ii" or $exdata[0] == "Xi" or $exdata[0] == "Wi" or $ex_data[0] == "readdd" or $exdata[0] == "Vi" or $data == "YESSend" or $exdata[0] == "YSb" or $data == "login" or $data == "login_2" or $data == "logout" or $data == "sign_in") {
        $site = $BUYSNUM['number'][$Detector]['site'];
        $number = $BUYSNUM['number'][$Detector]['phone'];
        $idnumber = $BUYSNUM['number'][$Detector]['idnumber'];
        $finish = $BUYSNUM['number'][$Detector]['finish'];
        $times = $BUYSNUM['number'][$Detector]['times'];
        $idSend = $BUYSNUM['number'][$Detector]['idSend'];
        $status = $BUYSNUM['number'][$Detector]['status'];
        $app = $BUYSNUM['number'][$Detector]['app'];
        $api = json_decode(file_get_contents("https://" . $_SERVER['SERVER_NAME'] . "/$bot/api-sites.php?action=getStatus&site=$site&app=$app&idnumber=$idnumber&number=$number"), 1);
        $status = $api['status'];
        $code = $api['code'];
        $agen = $api['agen'];
        $Location = $api['Location'];
        $api2 = json_decode(file_get_contents("https://" . $_SERVER['SERVER_NAME'] . "/$bot/api-sites.php?action=addBlack&site=$site&app=$app&idnumber=$idnumber&number=$number"), 1);
        $status2 = $api2['status'];
        if ($user == null) {
            $uss = "لايوجد ❌";
        } else {
            $uss = "[@$user]";
        }
        if ($code != null and $status == 1) {
            bot('answercallbackquery', [
                'callback_query_id' => $update->callback_query->id,
                'text' => '⚠️ - لايمكنك أن تقوم بشراء أي شيء لأن لديك عملية شراء لم تقم ب إكمالها 🙂',
                'show_alert' => true
            ]);
            unlink("data/id/$id/step.txt");
            exit;
        } elseif (time() - $times < 120 and $status == 1 and $site == "onlinesim") {
            bot('answercallbackquery', [
                'callback_query_id' => $update->callback_query->id,
                'text' => "❌ - لا يمكنك إلغاء الرقم لأن طلبك يحتاج لمرور دقيقتين ♻️",
                'show_alert' => true
            ]);
            unlink("data/id/$id/step.txt");
            exit;
        } elseif ($code == null and $status == 1) {
            $BUYSNUM['number'][$Detector]['status'] = -1;
            NumbBuys($BUYSNUM, $EM);
            $ORDERALL[$idSend]['status'] = -1;
            OrdAll($ORDERALL);
            unlink("data/id/$id/restriction.txt");
        }
    }
}

#=========={تسجيل الدخول}==========#
if ($data == "login") {
    $emile = $EMIL[$chat_id]['emil'];
    $password = $EMILS['emils'][$emile]['pass'];
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
*♻️ - يرجى إرسال الحساب او الإيميل الذي تريد تسجيل الدخول عليه ، (يجب أن يكون هذا الإيميل مسجل بالبوت. ⚠️)

☑️ - اذا لديك حساب من قبل سيضهر في الأسفل ، إضغط عليه لتسجيل الدخول ✅.*
",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "- $emile .", 'callback_data' => "emils-$emile-$password"]],
                [['text' => '- رجوع.', 'callback_data' => "startup"]]
            ]
        ])
    ]);
    file_put_contents("data/id/$id/step.txt", "login");
    exit;
}
if ($text != '/start' && $text != null && $step == 'login') {
    $pass = $EMILS['emils'][$text]['pass'];
    $IDem = $EMILS['emils'][$text]['id'];
    if ($EMILS['emils'][$text]['emil'] == null) {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
⚠️ *- لم يتم إنشاء حساب ب هذا الإيميل في البوت!*
",
            'parse_mode' => "MarkDown",
            'reply_to_message_id' => $message_id,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => "↪️ إنشاء حساب جديد ☑️", 'callback_data' => "sign_in"]],
                    [['text' => '- رجوع.', 'callback_data' => "startup"]]
                ]
            ])
        ]);
        exit;
    }
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
☑️ *- يرجى الإنتظار يتم فحص الحساب ⏳...*
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message_id,
    ]);
    sleep(1);
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
🔐 *- أرسل كلمة مرور حسابك الأن* ☑️
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "⚠️ - طلب المساعدة", 'callback_data' => "super"]],
                [['text' => '- رجوع.', 'callback_data' => "startup"]]
            ]
        ])
    ]);
    file_put_contents("data/id/$id/step.txt", "pasword|$text");
    exit;
}
if ($text != '/start' && $text != null && $exstep[0] == 'pasword') {
    $emile = $exstep[1];
    $passe = $EMILS['emils'][$emile]['pass'];
    if ($text !== $passe) {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
*♻️ - كلمة المرور ليست صحيحة ⛔️*
",
            'parse_mode' => "MarkDown",
            'reply_to_message_id' => $message_id,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '- رجوع.', 'callback_data' => "startup"]]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
    $get = bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
♻️ *- تم التحقق بنجاح، انتظر قليلا ....*
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message_id,
    ]);
    sleep(1);
    $get = $get->result->message_id;
    bot('deletemessage', [
        'chat_id' => $chat_id,
        'message_id' => $get,
    ]);
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
⤵️ *- يمكنك الآن الضغط على الإيميل بالأسفل للتسجيل* ☑️
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message_id,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "$emile", 'callback_data' => "emils-$emile-$passe"]]
            ]
        ])
    ]);
    unlink("data/id/$id/step.txt");
    exit;
}

#=========={إنشاء حساب}=========#
if ($data == "sign_in") {
    $margin = rand(100000, 999999);
    if ($EMIL[$chat_id]['emil'] != null) {
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "
☑️ - يوجد لديك حساب من قبل ⚠️
",
            'show_alert' => true
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
✅ - لأمان حسابك *وحماية خصوصيتك*، نحتاج للتحقق من *انك انساناً ولست روبوتاً* اولاً. ♻️

🔘 - قم بكتابة الرقم الظاهر أمامك *[ $margin ]* 

☑️ - أرسل لنا *الإجابة الصحيحة* للتحقق من *انك لست روبوتاً.*
",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => '- رجوع 🔜', 'callback_data' => "startup"]]
            ]
        ])
    ]);
    file_put_contents("data/id/$id/step.txt", "sign_in|$margin");
    exit;
}
if ($text != '/start' && $text != null && $exstep[0] == 'sign_in') {
    $margin = $exstep[1];
    $xzz = "@QGQFQ.COM";
    $code = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0 - 7);
    $emile = "$code$xzz";
    $password = substr(str_shuffle("12345"), 0 - 5);
    if ($user == null) {
        $uss = "لايوجد ❌";
    } else {
        $uss = "[@$user]";
    }
    if ($EMILS['emils'][$emile]['emil'] == $emile) {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
*❌ -  عذرا عزيزي حدث خطأ في البوت أرجوا إعادة المحاولة مرة أخرى 🙃*
",
            'parse_mode' => "MarkDown",
            'reply_to_message_id' => $message_id,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '- رجوع 🔙', 'callback_data' => "startup"]]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
    if ($margin != $text) {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "
*❌ - إجابة غير صحيحة! حاول مجددا.*
",
            'parse_mode' => "MarkDown",
            'reply_to_message_id' => $message_id,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '- رجوع 🔜', 'callback_data' => "startup"]]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
*✅ - إجابة صحيحة ⚜!

♻️ - تتم معالجة البيانات يرجى الإنتظار قليلاً.*
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message->message_id,
    ]);
    sleep(2);
    bot('sendMessage', [
        'chat_id' => $chat_id,
        'text' => "
☑️ - تم إنشاء حساب جديد لك.!✔

📧 - الحساب: *$emile*
🔐 - كلمة السر: *$password*
🆔 - أيدي الحساب: *$chat_id*

⚠️ - ملاحظة: *قم بتغيير كلمة مرورك من الإعدادات حتى تستطيع تذكرها متى ماشئت.*

⚠️ - ملاحظة: *لاتعطي كلمة مرورك لأي شخص حتى تحفظ حسابك من الإختراق.*

✅ *- إضغط على حسابك الأن ⬇️ للدخول للبوت.*
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message->message_id,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => '⚜ - تسجيل الدخول', 'callback_data' => "emils-$emile-$password"]]
            ]
        ])
    ]);
    bot('sendMessage', [
        'chat_id' => $eer,
        'text' => "
☑️ - تم إنشاء حساب جديد في البوت.!✔

✅ - الحساب: *$emile*
🔐 - كلمة السر: *$password*
🆔 - أيدي الحساب: [$chat_id](tg://openmessage?user_id=$chat_id)
⚜ - إسم العضو: [$first](tg://user?id=$chat_id)
🌀 - المعرف: $uss
",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "☑️ - رابط العضو ↖️", 'url' => "tg://openmessage?user_id=$id"]]
            ]
        ])
    ]);
    $EMIL[$chat_id]['emil'] = $emile;
    $EMIL[$chat_id]['pass'] = $password;
    $EMIL[$chat_id]['Date_created'] = "$D/$M/$Y $tims";
    Aemil($EMIL);
    $EMILS['emils'][$emile]['emil'] = $emile;
    $EMILS['emils'][$emile]['pass'] = $password;
    $EMILS['emils'][$emile]['Date_created'] = "$D/$M/$Y $tims";
    $EMILS['emils'][$emile]['id'] = $chat_id;
    Bemil($EMILS);
    unlink("data/id/$id/step.txt");
    exit;
}

#=========={الإحصائيات}==========#
if ($data == "statsbot2") {
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
📊 - *إحصائيات البوت :*

✅ - عدد العملاء النشطين: *$count* 🙋🏻
📞 - عدد الأرقام المكتملة: *$numbot* 🎖
☎️ - عدد الأرقام الجاهزة التي تم شراؤها: *$readybot* 🚀
🎟 - عدد الكروت التي تم شراؤها: *$cardbot* 🏆
💸 - وصل الروبل المصروف الى: *₽ $money* 💰
☑️ - عدد الروبل المتبقى: *₽ $poi_money* 💰
",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => '- رجوع.', 'callback_data' => "startup"]]
            ]
        ])
    ]);
    unlink("data/id/$id/step.txt");
    exit;
}

#========={شرح البوت}=========#
if ($data == "to_explain") {
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
• *مرحبا بك عزيزي في قسم التعليمات والشروط.*

• *شروط البوت :* ↘️

- هذا البوت يقوم بجلب أرقام وهمية لجميع مواقع السوشيل ميديا ولمعضم الدول.
- البوت لايتحمل مسؤولية الأرقام في حالة أنها انحظرت او انسرقت , بمعنى البوت لايتحمل مسؤولية الرقم بعد شرائه.
- فضلا يرجى عدم إستعمال الأرقام في أشياء قد تغضب الله عز وجل أو الإنحراف الإسلامي كالإختراقات وغيره.

• *تعليمات عن كيفية إستعمال البوت :* ↘️

- عندما تقوم بشراء رقم يجب أن تقوم بفحصها في حالة كانت الأرقام مستخدمة قم ب إلغاء الرقم وفي حالة كانت الأرقام جديده قم بشرائها.
- لفحص الرقم, أضغط على زر *رؤية الرقم في واتسأب* بعد شراء الرقم, سيقوم بتوجيهك إلى الواتساب, في حالة قال لك *إن رقم الهاتف هذا +967••• @QGQFQ ليس في واتسأب* هذا يعني أن الرقم جديد ولم يستخدم في واتسأب من قبل, *أما في الحالات الأخرى فهذا يعني أن الرقم مستخدم في واتسأب ولا نتحمل مسؤولية تفعيلة في أي حال من الأحوال.*
- قد لا تصل الأكواد إلى بعض الأرقام لتطبيق *واتسأب* , لذلك ياعزيزي يمكنك  إستخدام واتسأب أعمال قد تم نشرة في قناتنا على التيليجرام [إضغط هنا لتحميلها](t.me/$chall/2186).
- في حالة لم يصل الكود في هذه النسخة, قم بعمل إرسال رسالة مجددا في الواتسأب وأنتظر نصف دقيقة وأضغط تحديث, في حالة لم يصل بعد قم بإلغائه وشراء رقم آخر.

• *للإستفسار تواصل معنا: @$useradmin* .
",
        'parse_mode' => "MarkDown",
        'disable_web_page_preview' => true,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => '- رجوع.', 'callback_data' => "startup"]]
            ]
        ])
    ]);
    unlink("data/id/$id/step.txt");
    exit;
}

#========={الاعضاء الجدد}=========#
if ($data == "Important") {
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
*- هام للأعضاء الجُدد في بوت اكسبلورر.*

- هذا البوت مخصّص لعمل أرقام وهمية لتفعيل مواقع التواصل الإجتماعي ، *لانتحمل مسؤولية الأرقام بعد شراءِها.*

*- يعمل البوت عبر عدّة سيرفرات او عدّة مورّدين مختصّين بتوفير الأرقام من دُول معيَّنة* ، ولبرامج محدّدة ، وكلّ سيرفر او مُورد له *سِعر خاص فيه.*

*- هذا البوت لايظمن أي رقم بعد شراءِه* ، حتى اذا لم يشتغل لديك ، مجرد شراء الرقم يعني إخلاء المسؤولية، وهذا موضح في *شروط الاستخدام.*

*- مسؤولية استخدامك للأرقام على رب العباد ، لذلك لاتستخدم الأرقام في اشياء مخالفة للدين.*
",
        'parse_mode' => "MarkDown",
        'disable_web_page_preview' => true,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => '- رجوع.', 'callback_data' => "startup"]]
            ]
        ])
    ]);
    unlink("data/id/$id/step.txt");
    exit;
}

#=========={دخول للبوت}==========#
if ($exdata[0] == "emils") {
    $emile = $exdata[1];
    $password = "$exdata[2]";
    $pase = $EMILS['emils'][$emile]['pass'];
    $pase = "$pase";
    $idEM = $EMILS['emils'][$emile]['id'];
    $rubles = file_get_contents("EMILS/$emile/rubles.txt");
    $Balance = file_get_contents("EMILS/$emile/points.txt");
    $consumers = $rubles - $Balance;
    if ($user == null) {
        $uss = "لايوجد ❌";
    } else {
        $uss = "[@$user]";
    }
    if ($EMILS['emils'][$emile]['emil'] == null) {
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "
⚠️ - عذرا هذا الحساب قد تم حذفة من البوت بشكل كامل ❎
",
            'show_alert' => true
        ]);
        unlink("data/id/$id/step.txt");
    } elseif ($password !== $pase and $sudo != $id) {
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "
⚠️ - عذرا كلمة المرور ل هذا الحساب قد تم تغييرة ☑️
",
            'show_alert' => true
        ]);
        unlink("data/id/$id/step.txt");
    } else {
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
👨‍✈️ *⁞ مرحبا بك* [$first](tg://user?id=$id) ؛
🏛 *⁞ هذه تفاصيل حسابك في بوت. @QGQFQ* ⬇️

📨︙حسابك: *$emile* 
💰︙رصيدك: *₽ $Balance 💸*
🆔︙أيدي حسابك: *$id ⚜*
♻️︙رصيدك المصرف: *$consumers 🗞*

☑️ *⁞ قناة البوت الرسمية: @$chall
🎬︙قم بالتحكم بالبوت الأن عبر الضعط على الأزرار.*
",
            'parse_mode' => "MarkDown",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '☎️︙شراء ارقـام وهمية', 'callback_data' => 'Buynum']],
                    [['text' => '💰︙شحن رصيدك', 'callback_data' => 'Payment'], ['text' => '👤︙قسم الرشق', 'callback_data' => 'sh']],
                    [['text' => '🅿️︙كشف الحساب', 'callback_data' => "Record"], ['text' => '🛍︙قسم العروض', 'callback_data' => "Wo"]],
                    [['text' => '☑️︙قسم العشوائي', 'callback_data' => "worldwide"], ['text' => '👑︙قسم الملكي', 'callback_data' => "saavmotamy"]],
                    [['text' => '💰︙ربح روبل مجاني 🤑', 'callback_data' => "assignment"]],
                    [['text' => '💳︙متجر الكروت', 'callback_data' => "readycard-10"], ['text' => '🔰︙الارقام الجاهزة', 'callback_data' => 'ready']],
                    [['text' => '👨‍💻︙قسم الوكلاء', 'callback_data' => "gents"], ['text' => '⚙︙إعدادات البوت', 'callback_data' => "MyAccount"]],
                    [['text' => '📮︙تواصل الدعم أونلاين', 'callback_data' => "super"]]
                ]
            ])
        ]);
        $EMILNow['emil'][$chat_id] = $emile;
        $EMILNow['password'][$chat_id] = $pase;
        Now($EMILNow);
        unlink("data/id/$id/step.txt");
    }
}

#=========={القائمة الرئيسية}==========#
if ($data == "back") {
    if ($EM == null or $EMILS['emils'][$EM]['emil'] == null or $passewo != $perrewo) {
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
♐️ - مرحبا بك [$first](tg://user?id=$id) ؛ 🤍

*- في بوت @QGQFQ ؛ البوت الأفضل على التليجرام والذي يقوم بتوفير *خدمات الأرقام الوهمية* ل مواقع السوشيال ميديا مثل *التيليجرام والواتساب والتويتر وغيره* 👾

*- قم بإنشاء حساب جديد* ؛ واذا كان لديك حساب من قبل: قم بالضغط على زر *تسجيل الدخول* ☑️
",
            'parse_mode' => "MarkDown",
            'disable_web_page_preview' => true,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => 'لديكَ حساب؟ تسجيل دخول 📲', 'callback_data' => "login"]],
                    [['text' => 'إنشاء حساب جديد ☑️', 'callback_data' => "sign_in"]],
                    [['text' => 'شروط الإستخدام وإخلاء للمسؤلية 🚨', 'callback_data' => "to_explain"]],
                    [["text" => 'إدارة البوت 👨🏻‍💻', "url" => "tg://user?id=$sudo"]],
                    [['text' => 'هام للأعضاء الجُدد ⚠️', 'callback_data' => "Important"]],
                    [['text' => 'إحصائيات المستخدمين 📈', 'callback_data' => 'statsbot2']]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
    } else {
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
👨‍✈️ *⁞ مرحبا بك* [$first](tg://user?id=$id) ؛
🏛 *⁞ هذه تفاصيل حسابك في البوت* ⬇️

📨︙حسابك: *$EM* 
💰︙رصيدك: *₽ $Balance 💸*
🆔︙أيدي حسابك: *$id ⚜*
♻️︙رصيدك المصرف: *$consumers 🗞*

☑️ *⁞ قناة البوت الرسمية: @$chall
🎬︙قم بالتحكم بالبوت الأن عبر الضعط على الأزرار.*
",
            'parse_mode' => "MarkDown",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '☎️︙شراء ارقـام وهمية', 'callback_data' => 'Buynum']],
                    [['text' => '💰︙شحن رصيدك', 'callback_data' => 'Payment'], ['text' => '👤︙قسم الرشق', 'callback_data' => 'sh']],
                    [['text' => '🅿️︙كشف الحساب', 'callback_data' => "Record"], ['text' => '🛍︙قسم العروض', 'callback_data' => "Wo"]],
                    [['text' => '☑️︙قسم العشوائي', 'callback_data' => "worldwide"], ['text' => '👑︙قسم الملكي', 'callback_data' => "saavmotamy"]],
                    [['text' => '💰︙ربح روبل مجاني 🤑', 'callback_data' => "assignment"]],
                    [['text' => '💳︙متجر الكروت', 'callback_data' => "readycard-10"], ['text' => '🔰︙الارقام الجاهزة', 'callback_data' => 'ready']],
                    [['text' => '👨‍💻︙قسم الوكلاء', 'callback_data' => "gents"], ['text' => '⚙︙إعدادات البوت', 'callback_data' => "MyAccount"]],
                    [['text' => '📮︙تواصل الدعم أونلاين', 'callback_data' => "super"]]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
        unlink("data/id/$id/twas.txt");
        exit;
    }
}
if ($data == "sh") {
    bot('answercallbackquery', [
        'callback_query_id' => $update->callback_query->id,
        'text' => "- عذراً قسم الرشق مغلق حالياً\n- يمكنك الرشق عبر مراسلة المالك",
        'show_alert' => true
    ]);
    unlink("data/id/$id/step.txt");
    exit;
}

#=========={الحماية}==========#
if ($text != null and $text != '/my' and $text != '/start ONE' and $step != null and $twas != 'tw' and $id != $sim and $id != $PAY and $id != $ess and $id != $eer and $id != $sudo) {
    if ($EM == null or $EMILS['emils'][$EM]['emil'] == null or $passewo != $perrewo) {
        bot('SendMessage', [
            'chat_id' => $chat_id,
            'text' => "
♐️ - مرحبا بك [$first](tg://user?id=$id) ؛ 🤍

*- في بوت @QGQFQ* ؛ البوت الأفضل على التليجرام والذي يقوم بتوفير *خدمات الأرقام الوهمية* ل مواقع السوشيال ميديا مثل *التيليجرام والواتساب والتويتر وغيره* 👾

*- قم بإنشاء حساب جديد* ؛ واذا كان لديك حساب من قبل: قم بالضغط على زر *تسجيل الدخول* ☑️
",
            'parse_mode' => "MarkDown",
            'disable_web_page_preview' => true,
            'reply_to_message_id' => $message_id,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => 'لديكَ حساب؟ تسجيل دخول 📲', 'callback_data' => "login"]],
                    [['text' => 'إنشاء حساب جديد ☑️', 'callback_data' => "sign_in"]],
                    [['text' => 'شروط الإستخدام وإخلاء للمسؤلية 🚨', 'callback_data' => "to_explain"]],
                    [["text" => 'إدارة البوت 👨🏻‍💻', "url" => "tg://user?id=$sudo"]],
                    [['text' => 'هام للأعضاء الجُدد ⚠️', 'callback_data' => "Important"]],
                    [['text' => 'إحصائيات المستخدمين 📈', 'callback_data' => 'statsbot2']]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
}
if ($text == null and $data != null and $data != "super" and $id != $sim and $id != $buys and $id != $PAY and $id != $ess and $id != $eer and $id != $sudo) {
    if ($EM == null or $EMILS['emils'][$EM]['emil'] == null or $passewo != $perrewo) {
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
♐️ - مرحبا بك [$first](tg://user?id=$id) ؛ 🤍

*- في بوت @QGQFQ* ؛ البوت الأفضل على التليجرام والذي يقوم بتوفير *خدمات الأرقام الوهمية* ل مواقع السوشيال ميديا مثل *التيليجرام والواتساب والتويتر وغيره* 👾

*- قم بإنشاء حساب جديد* ؛ واذا كان لديك حساب من قبل: قم بالضغط على زر *تسجيل الدخول* ☑️
",
            'parse_mode' => "MarkDown",
            'disable_web_page_preview' => true,
            'reply_to_message_id' => $message_id,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => 'لديكَ حساب؟ تسجيل دخول 📲', 'callback_data' => "login"]],
                    [['text' => 'إنشاء حساب جديد ☑️', 'callback_data' => "sign_in"]],
                    [['text' => 'شروط الإستخدام وإخلاء للمسؤلية 🚨', 'callback_data' => "to_explain"]],
                    [["text" => 'إدارة البوت 👨🏻‍💻', "url" => "tg://user?id=$sudo"]],
                    [['text' => 'هام للأعضاء الجُدد ⚠️', 'callback_data' => "Important"]],
                    [['text' => 'إحصائيات المستخدمين 📈', 'callback_data' => 'statsbot2']]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
}
if ($exdata[0] == "Ii" or $exdata[0] == "Xi") {
    $zero = $exdata[1];
    $zero = md5($zero);
    $price = $buy['number'][$zero]['price'];
    if ($price > $Balance or $Balance < $price or $Balance == 0 or $Balance === 0 or $Balance < 0) {
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
☑️ *- لايوجد لديك رصيد كافي لشراء هذا الرقم
💸 - رصيدك المتوفر في حسابك >> ₽ $Balance*
",
            'parse_mode' => "MarkDown",
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
}
if ($exdata[0] == "Vi") {
    if ($exdata[2] > $Balance or $Balance < $exdata[2] or $Balance == 0 or $Balance === 0 or $Balance < 0) {
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⚠️ - رصيدك غير كافية لشراء بطاقة الشحن 💰",
            'show_alert' => true
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
}
if ($ex_data[0] == "readdd") {
    if ($storenumber['ready'][$ex_data[1]]['price'] > $Balance or $Balance < $storenumber['ready'][$ex_data[1]]['price'] or $Balance == 0 or $Balance === 0 or $Balance < 0) {
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
☑️ *- لايوجد لديك رصيد كافي لشراء هذا الرقم
💸 - رصيدك المتوفر في حسابك >> ₽ $Balance*
",
            'parse_mode' => "MarkDown",
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
}
if ($exdata[0] == "YSg" or $exdata[0] == "YSb") {
    if ($exdata[2] > $Balance or $Balance < $exdata[2] or $Balance == 0 or $Balance === 0 or $Balance < 0) {
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⚠️ - رصيدك غير كافية لتحويل رصيد إلى الأصدقاء 💰",
            'show_alert' => true
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
}
if ($data == "YESSend") {
    if (20 > $Balance or $Balance < 20 or $Balance == 0 or $Balance === 0 or $Balance < 0) {
        bot('answercallbackquery', [
            'callback_query_id' => $update->callback_query->id,
            'text' => "⚠️ - لايوجد لديك رصيد كافي للتحويل 💰",
            'show_alert' => true
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
}
if ($admins[$EM]["check"] != null and time() - $admins[$EM]["time"] >= $admins[$EM]["end"]) {
    unset($admins[$EM]);
    Admins($admins);
}
if ($exdata[0] == "Ii" or $exdata[0] == "Xi" or $exdata[0] == "Wi" or $exdata[0] == "Vi" or $exdata[0] == "YSb" or $exdata[0] == "YSg" or $data == "YESSend" or $ex_data[0] == "readdd") {
    $v = $admins[$EM]["end"] - (time() - $admins[$EM]["time"]);
    if ($admins[$EM]["check"] != null and time() - $admins[$EM]["time"] < $admins[$EM]["end"]) {
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
⚠️ *- تم تقييدك من البوت لسبب مخالفة مالك البوت ولن تستطيع الإستفاده من البوت ب هذا الشكل
♻️ - إذا تظن أنك مقيد لأسباب خاطئة تواصل مع الدعم الأنلاين في الزر الأسفل
⏰ - الوقت المتبقي للتقييد: $v ثانية*
",
            'parse_mode' => "MarkDown",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '🚀 تواصل مع الدعم 🚀', 'callback_data' => "super"]],
                    [['text' => '- رجوع.', 'callback_data' => 'back']]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
        exit;
    }
}

#=========={الإحالات}===========#
if ($data == "assignment") {
    if ($assignment["code"][$EM] == null) {
        $cod = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"), -8);
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
💸 *- إربح روبل الآن مجاناً* عبر مشاركة رابط البوت الى أصدقائك 👥
*- واحصل على $assignru روبل* مقابل كل شخص يقوم بالدخول إلى البوت عبر الرابط الخاص بك ✅

☑ - رابط الدعوة الخاص بك: *https://t.me/$me?start=$cod*

*- عدد من قام بالدخول عبر رابطك: $counmy 👤
- إجمالي أرباحك حتى الآن: $counmyru ₽* 💰
",
            'parse_mode' => "MarkDown",
            'disable_web_page_preview' => true,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '- رجوع.', 'callback_data' => 'back']]
                ]
            ])
        ]);
        $assignment["emils"][$cod] = $EM;
        $assignment["code"][$EM] = $cod;
        Ssai($assignment);
        unlink("data/id/$id/step.txt");
    }
    if ($assignment["code"][$EM] != null) {
        $cod = $assignment["code"][$EM];
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
💸 *- إربح روبل الآن مجاناً* عبر مشاركة رابط البوت الى أصدقائك 👥
*- واحصل على $assignru روبل* مقابل كل شخص يقوم بالدخول إلى البوت عبر الرابط الخاص بك ✅

☑ - رابط الدعوة الخاص بك: *https://t.me/$me?start=$cod*

*- عدد من قام بالدخول عبر رابطك: $counmy 👤
- إجمالي أرباحك حتى الآن: $counmyru ₽* 💰
",
            'parse_mode' => "MarkDown",
            'disable_web_page_preview' => true,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => '- رجوع.', 'callback_data' => 'back']]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
    }
}

#=========={شراء كروت}==========#
if ($exdata[0] == "readycard") {
    $pri = $exdata[1];
    $pri = "$pri.00";
    if ($pri < 10 or $pri > 10000) {
        unlink("data/id/$id/step.txt");
    } else {
        $price = $pri * 0.04 + $pri;
        $t = $pri + 1;
        $i = $pri - 1;
        $v = $pri + 10;
        $k = $pri - 10;
        bot('EditMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $message_id,
            'text' => "
☑️ *- عبر هذا القسم تستطيع شراء كرت شحن في البوت وبيعة او إهدائة لأي صديق لك*
✅ - يتم تحديث *السعر تلقائياً عند الضغط على (➕ أو ➖ )* ⬇️

🅿️ - قيمة الكرت: *₽ $pri*
💸 - سعر الكرت: *₽ $price*
",
            'parse_mode' => "MarkDown",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [['text' => "☑️ شراء كرت شحن بقيمة ( ₽ $pri )", 'callback_data' => "Vi-$pri-$price"]],
                    [['text' => "➖ 1 ₽", 'callback_data' => "readycard-$i"], ['text' => "➕ 1 ₽", 'callback_data' => "readycard-$t"]],
                    [['text' => "➖ 10 ₽", 'callback_data' => "readycard-$k"], ['text' => "➕ 10 ₽", 'callback_data' => "readycard-$v"]],
                    [['text' => '- رجوع.', 'callback_data' => 'MyAccount']]
                ]
            ])
        ]);
        unlink("data/id/$id/step.txt");
    }
}
if ($exdata[0] == "Vi") {
    $point = $exdata[1];
    $price = $exdata[2];
    $cardbot2 = $cardbot + 1;
    $card = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890"), -8);
    $idcard = substr(str_shuffle('12345689807'), 1, 9);
    $pri = $price - $point;
    $Balancee = $Balance - $price;
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
☑️ *- ارجوا الانتظار ●○
?? - الكرت قيد التجهيز* ♻️
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message->message_id,
    ]);
    sleep(1);
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
☑️ *- ارجوا الانتظار ●●○
🧩 - جاري شحن الكرت بقيمة ₽ $points* ♻️
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message->message_id,
    ]);
    sleep(1);
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
☑️ *- تم التجهيز بنجاح ●●●
🧩 - تم صنع كرت شحن بقيمة ₽ $points* ✅
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message->message_id,
    ]);
    sleep(1);
    bot('EditMessageText', [
        'chat_id' => $chat_id,
        'message_id' => $message_id,
        'text' => "
☑️ *- تم شراء الكرت بنجاح* ↘️

🎛 - أيدي المعاملة: *$idcard*
💰 - سعر الكرت: *₽ $price*
💸 - فئة الكرت: *₽ $point*
🎟 - الكرت: `$card` ⏭

✅ - *إضغط على الكرت ليتم نسخة!*
",
        'parse_mode' => "MarkDown",
        'reply_to_message_id' => $message->message_id,
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "☑️ صنع كرت شحن آخر! ↖️", 'callback_data' => 'readycard-10']],
                [['text' => "- رجوع.", 'callback_data' => "MyAccount"]]
            ]
        ])
    ]);
    bot('sendMessage', [
        'chat_id' => $eer,
        'text' => "
🎟 - تم شراء كرت الآن ⚜

🅿️ - فئة الكرت: *₽ $point*
🛅 - الكرت: *$card*
💰 - رصيده المتبقي: *$Balancee*
🧭 - رقم العملية: *$idcard*
🛃 - سعر الكرت: *₽ $price*
🤸‍♂ - الحساب: *$EM* 🌐
🔎 - رقم العمل: *$cardbot2*
",
        'parse_mode' => "MarkDown",
        'reply_markup' => json_encode([
            'inline_keyboard' => [
                [['text' => "☑️ - رابط العضو ↖️", 'url' => "tg://openmessage?user_id=$id"]]
            ]
        ])
    ]);
    $sool['c