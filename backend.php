<?php
function getLocationWithCurl($ip = null) {
    if (!$ip) {
        //$ip = $_SERVER['REMOTE_ADDR'];
        $ip = getRealPublicIP();
        //print_r($_SERVER['REMOTE_ADDR']);
        
        // Handle localhost IP
        if ($ip == '::1' || $ip == '127.0.0.1') {
            $ip = '8.8.8.8';
        }
    }
    
    $ch = curl_init();
    $url = "https://ipapi.co/{$ip}/json/";
    
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 5,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_error($ch)) {
        curl_close($ch);
        return ['error' => 'cURL Error: ' . curl_error($ch)];
    }
    
    curl_close($ch);
    
    if ($httpCode === 200 && $response) {
        return json_decode($response, true);
    }
    
    return ['error' => 'Failed to fetch location data'];
}

function getRealPublicIP() {
    $services = [
        'https://api.ipify.org',
        'https://icanhazip.com',
        'https://checkip.amazonaws.com',
        'https://ipinfo.io/ip'
    ];
    
    foreach ($services as $service) {
        $ip = @file_get_contents($service);
        if ($ip && filter_var(trim($ip), FILTER_VALIDATE_IP)) {
            return trim($ip);
        }
    }
    
    return '8.8.8.8';
}

$location = getLocationWithCurl();

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

function get5DayForecast($city, $apiKey) {
    $url = "https://api.openweathermap.org/data/2.5/forecast?q=" . urlencode($city) . "&appid=" . $apiKey . "&units=metric";
    
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10
    ]);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        return json_decode($response, true);
    }
    
    return null;
}

$cityName;
if (@$_GET['city'] == null){
    $cityName = $location['city'];
} else {
    $cityName = $_GET['city'];
}
?>

<!-- <!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teszt</title>
</head>
<body>
    Város: <input type="text" id="city" name="city"><button onClick="refresh()">Keresés</button>
    <p>Város: <?= $data->name ?></p>
    <p>Időjárás típusa: <?= $data->weather[0]->main ?></p>
    <p>Hőmérséklet: <?= $data->main->temp ?>°</p>
    <p>Szélsebesség: <?= $data->wind->speed ?> m/s</p>
    <p>Szélirány: <?= $data->wind->deg ?>°</p>
    <script>
        function refresh(){
            cityName = document.getElementById("city").value;
            window.location = window.location + "?city=" + cityName;
        }   
    </script>
</body>
</html> -->