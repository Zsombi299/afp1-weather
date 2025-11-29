<?php require_once 'backend.php';

echo "PÉLDA MINDEN ATTRIBÚTUMRA <br>";

echo "hosszúság: " . $data->coord->lon;
echo "<br>";
echo "szélesség: " . $data->coord->lat;
echo "<br>";
echo "időjárás id: " . $data->weather[0]->id;
echo "<br>";
echo "időjárás fő leírása: " . $data->weather[0]->main;
echo "<br>";
echo "időjárás hosszabb leírása: " . $data->weather[0]->description;
echo "<br>";
echo "időjárás ikon: " . $data->weather[0]->icon;
/*
példa felhasználás:
<img src="https://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon" />
*/
echo "<br>";
echo "adatforrás: " . $data->base;
echo "<br>";
echo "hőmérséklet: " . $data->main->temp;
echo "<br>";
echo "érzeti hőmérséklet: " . $data->main->feels_like;
echo "<br>";
echo "min hőm: " . $data->main->temp_min;
echo "<br>";
echo "max hőm: " . $data->main->temp_max;
echo "<br>";
echo "légnyomás: " . $data->main->pressure;
echo "<br>";
echo "páratartalom: " . $data->main->humidity;
echo "<br>";
echo "tengerszint: " . $data->main->sea_level;
echo "<br>";
echo "talajszint(idk): " . $data->main->grnd_level;
echo "<br>";
echo "láthatóság: " . $data->visibility;
echo "<br>";
echo "szél sebesség: " . $data->wind->speed;
echo "<br>";
echo "szélirány: " . $data->wind->deg;
echo "<br>";
echo "széllökés: " . $data->wind->gust;
echo "<br>";
echo "felhősség(%): " . $data->clouds->all;
echo "<br>";
echo "mikor lett mérve az idójárás: " . $data->dt;
echo "<br>";
echo "Internal OpenWeatherMap system type identifier: " . $data->sys->type;
echo "<br>";
echo "Internal OpenWeatherMap station/system identifier: " . $data->sys->id;
echo "<br>";
echo "Ország: " . $data->sys->country;
echo "<br>";
echo "napkelte: " . $data->sys->sunrise;
echo "<br>";
echo "napnyugta: " . $data->sys->sunset;
echo "<br>";
echo "időzóna: " . $data->timezone;
echo "<br>";
echo "város id: " . $data->id;
echo "<br>";
echo "város név: " . $data->name;
echo "<br>";
echo "http response code: " . $data->cod;
echo "<br>";
$forecast = get5DayForecast($cityName, $apiKey);
if ($forecast) {
    echo "Példa 5 napos előrejelzés";
    
    foreach ($forecast['list'] as $period) {
        echo "<div style='border:1px solid #ccc; margin:5px; padding:10px;'>";
        echo "<strong>Date/Time:</strong> " . date('Y-m-d H:i', $period['dt']) . "<br>";
        echo "<strong>Temp:</strong> " . $period['main']['temp'] . "°C<br>";
        echo "<strong>Weather:</strong> " . $period['weather'][0]['description'] . "<br>";
        echo "<strong>Humidity:</strong> " . $period['main']['humidity'] . "%<br>";
        echo "<strong>Wind:</strong> " . $period['wind']['speed'] . " m/s<br>";
        echo "</div>";
    }
}
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "így lehet átalakítani a buta formátumot emberire amit az api ad vissza magától<br>";
echo "echo date('Y-m-d H:i:s', $data->dt);<br>";
echo date('Y-m-d H:i:s', $data->dt);
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "ez meg cakkunpakk a teljes data structure ha kéne valalmihez:<br>";
echo "<br>";
print_r($data);
?>