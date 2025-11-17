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
echo "<br>";
echo "<br>";
echo "<br>";
echo "ez meg cakkunpakk a teljes data structure ha kéne valalmihez:<br>";
echo "<br>";
print_r($data);
?>