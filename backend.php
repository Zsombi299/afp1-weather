<?php

define('API_KEY', 'e2d8124b4ac45c54fcabe703fa7a9492');

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


function getCityIdFromJson($filename = 'city.list.json', $cityName) {
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
//print_r($location);

@$cityId = getCityIdFromJson('city.list.json', $_POST['city']);
//echo $cityId;
if(!$cityId){
    $cityId = getCityIdFromJson('city.list.json', $location['city']);
}

function get5DayForecast($city, $apiKey = API_KEY) {
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

function getWeather($cityId, $apiKey = API_KEY){

    $googleApiUrl = "https://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;
    
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_VERBOSE, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if($httpCode === 200){
        $currentForecast = json_decode($response);
    }

    return null;
}


$cityName;
if(@$_GET['city'] == null){
    $cityName = $location['city'];
} else {
    $cityName = $_GET['city'];
}

$currentForecast = getWeather($cityName);
$predictedForecast = get5DayForecast($cityName);


$dailyForecast = [];

if (isset($predictedForecast['list'])) {
    
    foreach ($predictedForecast['list'] as $item) {
        // Kinyerjük a dátumot (óra/perc nélkül: pl. 2023-10-25)
        $date = date('Y-m-d', $item['dt']);
        
        // Aktuális 3-órás blokk minimum és maximum értékei
        $min = $item['main']['temp_min'];
        $max = $item['main']['temp_max'];
        // Ha ehhez a naphoz még nincs adatunk, létrehozzuk a kezdőértékeket
        if (!isset($dailyForecast[$date])) {
            $dailyForecast[$date] = [
                'date' => $date,
                'min' => $min,
                'max' => $max,
                // Opcionális: elmentjük az első időjárás leírást/ikont is referenciának
                'description' => $item['weather'][0]['description'],
                'icon' => $item['weather'][0]['icon']
            ];
        } else {
            // Ha már van adat, összehasonlítjuk és frissítjük, ha szélsőségesebbet találunk
            
            // Ha a mostani min kisebb, mint az eddig tárolt, felülírjuk
            if ($min < $dailyForecast[$date]['min']) {
                $dailyForecast[$date]['min'] = $min;
            }
            
            // Ha a mostani max nagyobb, mint az eddig tárolt, felülírjuk
            if ($max > $dailyForecast[$date]['max']) {
                $dailyForecast[$date]['max'] = $max;
            }
        }
    }
}

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
<script>
    async function getWeather() {
        const cityName = document.getElementById("search-field").value;
        const params = new URLSearchParams({city: city});
        const response = await fetch(`backend.php?${params}`);
        return await response.json();
    }
</script>