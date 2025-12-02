<?php
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

function getLocation($ip = null) {
    if (!$ip) {
        //$ip = $_SERVER['REMOTE_ADDR'];
        $ip = getPublicIP();
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

function getPublicIP() {
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


function getCityIdFromJson($filename, $cityName) {
    $jsonString = file_get_contents(__DIR__ . '/' . $filename);
    $cities = json_decode($jsonString, true);
    
    foreach ($cities as $city) {
        if (isset($city['name']) && strcasecmp($city['name'], $cityName) === 0) {
            return $city['id'];
        }
    }
    return null;
}

$location = getLocation();
$apiKey = "e2d8124b4ac45c54fcabe703fa7a9492";
@$cityId = getCityIdFromJson('city.list.json', $_GET['city']);
if(!$cityId){
    $location = getLocation();
    $cityId = getCityIdFromJson('city.list.json', $location['city']);
}

function getWeather($city){

}
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
$currentForecast = json_decode($response);


$cityName;
if(@$_GET['city'] == null){
    $cityName = $location['city'];
} else {
    $cityName = $_GET['city'];
}

$predictedForecast = get5DayForecast($cityName, $apiKey);

/* $forecast = get5DayForecast($cityName, $apiKey);
if ($forecast) {
    echo "<h3>5-Day Forecast for " . $forecast['city']['name'] . "</h3>";
    
    foreach ($forecast['list'] as $period) {
        echo "<div style='border:1px solid #ccc; margin:5px; padding:10px;'>";
        echo "<strong>Date/Time:</strong> " . date('Y-m-d H:i', $period['dt']) . "<br>";
        echo "<strong>Temp:</strong> " . $period['main']['temp'] . "°C<br>";
        echo "<strong>Weather:</strong> " . $period['weather'][0]['description'] . "<br>";
        echo "<strong>Humidity:</strong> " . $period['main']['humidity'] . "%<br>";
        echo "<strong>Wind:</strong> " . $period['wind']['speed'] . " m/s<br>";
        echo "</div>";
    }
} */
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
    <p>Város: <?= $currentForecast->name ?></p>
    <p>Időjárás típusa: <?= $currentForecast->weather[0]->main ?></p>
    <p>Hőmérséklet: <?= $currentForecast->main->temp ?>°</p>
    <p>Szélsebesség: <?= $currentForecast->wind->speed ?> m/s</p>
    <p>Szélirány: <?= $currentForecast->wind->deg ?>°</p>
    <script src="backend.js"></script>
</body>
</html> -->