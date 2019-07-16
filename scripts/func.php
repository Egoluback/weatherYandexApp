<?php
function getContentCurl($url, $headers){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    $info = curl_getinfo($ch);

    curl_close($ch);

    return json_decode($data, true);
}

function getApiKey(){
    // return '4ae8bc8b-a016-4f69-9e28-1ef1ffec8b0b';
    return 'de6aa569-d89b-4b10-9c84-fd1e1c5e4944';
}