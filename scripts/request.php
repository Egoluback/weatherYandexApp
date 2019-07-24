<?php
// REQUEST TO YANDEX SERVERS

if (isset($_POST['data'])) { // if we've got data from index.php

    include("func.php");
    $pos = $_POST['data'];

    $apiKey = getApiKey(); // getting api key
    $httpTitle = array('X-Yandex-API-Key: '.$apiKey); // setting HTTP headers
    $url = 'api.weather.yandex.ru/v1/informers?lat='.$pos[0].'&lon='.$pos[1]; // setting url: lat - latitude, lon - longitude

    $json = getContentCurl($url, $httpTitle); // sending request

    if (!$json or !isset($json["fact"])) { // if we've got error
        echo json_encode(array('isSuccess' => false, 'message' => json_encode($json))); // returning error message
    } else {
        echo json_encode(array('isSuccess' => true, 'data' => $json)); // returning correct message
    }
}