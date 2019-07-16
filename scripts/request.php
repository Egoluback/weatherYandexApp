<?php
if (isset($_POST['data'])){

    include("func.php");
    $pos = $_POST['data'];

    $apiKey = getApiKey();
    $httpTitle = array('X-Yandex-API-Key: '.$apiKey);
    $url = 'api.weather.yandex.ru/v1/informers?lat='.$pos[0].'&lon='.$pos[1];

    $json = getContentCurl($url, $httpTitle);

    if (!$json or !isset($json["fact"])){
        echo json_encode(array('isSuccess' => 'false', 'message' => json_encode($json)));
        // echo json_encode($json);
    } else{
        echo json_encode(array('isSuccess' => 'true', 'data' => $json));
    }
}