<?php

function getCityIdFromJson($filename, $cityName) {
    $jsonString = file_get_contents($filename);
    $cities = json_decode($jsonString, true);
    
    foreach ($cities as $city) {
        if (isset($city['name']) && strcasecmp($city['name'], $cityName) === 0) {
            return $city['id'];
        }
    }
    return null;
}

$apiKey = "e2d8124b4ac45c54fcabe703fa7a9492";
$cityId = getCityIdFromJson('city.list.json', $location['city']);
//$cityId = "721239";
$googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>