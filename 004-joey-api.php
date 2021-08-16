<?php

// TODO: 啟動session
// TODO: 如果沒登入 exit 前端導向;
// TODO: 如果沒登入 exit;

header('Content-Type: application/json'); //預設為HTML for Postman

//  output for return
$output = [
    'success' => false,
    'error' => '',
    'code' => 0, //error code
];

// finish verifying & exit
$finishVerify = function ($output) {
    // JSON_UNESCAPED_UNICODE in case Mandarin
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
};

// 防直接連結的壞孩子 💢  基本上只有直連才會出問題 因為從網站來的 就算硬改js POST值也會是空字串""
if (!isset($_POST['lat']) ||
    !isset($_POST['lng']) ||
    !isset($_POST['city']) ||
    !isset($_POST['locality']) ||
    !isset($_POST['activity_detail']) ||
    !isset($_POST['activity_type'])) {
    $output['error'] = 'Oops 💤 Info Missing 請不要恣意直接連結啊💢💢 ';
    $output['code'] = 400;
    $finishVerify($output);
}

// data from front-end
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$city = $_POST['city'];
$locality = $_POST['locality'];
$activity_detail = $_POST['activity_detail'];
$activity_type = $_POST['activity_type'];

// 防空字串輸入: 修改前端JS的壞孩子
if (empty($lat) ||
    empty($lng) ||
    empty($city) ||
    empty($locality) ||
    empty($activity_detail) ||
    empty($activity_type)) {
    $output['error'] = 'Oops 💤 Info Missing 請不要恣意關JS啊💢💢 ';
    $output['code'] = 402;
    $finishVerify($output);
}

// TODO: 資料驗證後 PDO 資料庫 update 這個等換上小組環境後 連結資料庫時處理
// NOTE 記得把 $_SESSION['user']['id'] 加進去變成 foreign key

// TODO: 回傳的值之後記得改
echo json_encode($_POST);
