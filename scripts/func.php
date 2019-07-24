<?php
// PHP FUNCTIONS

function getContentCurl($url, $headers){
    $ch = curl_init();

    // curl request options
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // setting HTTP headers
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // setting 'return' option(data won't be printed)
    curl_setopt($ch, CURLOPT_URL, $url); // setting url

    $data = curl_exec($ch); // sending request
    $info = curl_getinfo($ch); // getting information about request

    curl_close($ch); // closing connection

    return json_decode($data, true);
}

function getApiKey(){
    // your api key
    $key = '';
    return $key;
}