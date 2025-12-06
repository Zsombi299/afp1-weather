<?php
    require '..\backend.php';
?>

<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Előrejelzés</title>
</head>
<body>
    <div class="header">
        <table>
            <tr>
                <td>
                    <h1>Hiper Szuper Időjárás Jelentés OMG 3000</h1>
                    <p id="kreator">Készítette: Istvanovszki Zsombor, Bujpál Dorián Manó, Fegecs Armand Péter</p>
                </td>
                <td>
                    <div class="header">
                        <?php if (isset($_COOKIE['role']) && $_COOKIE['role'] === 'admin'): ?>
                            <div>
                                <p>Bejelentkezve adminként</p>
                                <button onclick="document.cookie='role=; path=/; max-age=0'; window.location.reload();" class="logout-button">Kijelentkezés</button>
                            </div>
                        <?php else: ?>
                            <form action="login.html">
                                <button type="submit">Bejelentkezés</button>
                            </form>
                        <?php endif; ?>
                        <form class="search-input" action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post"> <!-- az action-be kellene beleírni a keresés algoritmusát-->
                            <input id="search-field" type="text" name="city">
                            <input id="search-submit" type="submit" value="Keresés">
                        </form>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <h1>Jelenlegi időjárás itt: <?= $cityName ?></h1>
    <div class="forecast-container">
        <div class="forecast-content">
            <?php
                if ($currentForecast) {
                    $icon = $currentForecast->weather[0]->icon;
                    echo "<div style='border:1px solid #ccc; margin:5px; padding:10px; display: flex; gap: 15px; flex-wrap: wrap; align-items: center;'>";
                    echo "<img src=\"https://openweathermap.org/img/w/" . $icon . ".png\" class=\"weather-icon\" />";
                    echo "<span><strong>Hőm:</strong> " . round($currentForecast->main->temp) . "°C</span>";
                    echo "<span><strong>Érzeti hőm:</strong> " . round($currentForecast->main->feels_like) . "°C</span>";
                    echo "<span><strong>Időjárás:</strong> " . $currentForecast->weather[0]->description . "</span>";
                    echo "<span><strong>Légnyomás:</strong> " . $currentForecast->main->pressure . " hPa</span>";
                    echo "<span><strong>Pára:</strong> " . $currentForecast->main->humidity . "%</span>";
                    echo "<span><strong>Szél:</strong> " . $currentForecast->wind->speed . " m/s</span>";
                    echo "<span><strong>Napkelte:</strong> " . date('H:i:s',$currentForecast->sys->sunrise) . "</span>";
                    echo "<span><strong>Napnyugta:</strong> " . date('H:i:s',$currentForecast->sys->sunset) . "</span>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
    
    <h1>Előrejelzés órákra bontva itt: <?= $cityName ?></h1>

    <div class="forecast-container">
        <div class="forecast-content">
            <?php
                if ($predictedForecast && isset($predictedForecast['list'])){
                    foreach ($predictedForecast['list'] as $period) {
                        $icon = $period['weather'][0]['icon'];
                        echo "<div style='border:1px solid #ccc; margin:5px; padding:10px; display: flex; gap: 15px; flex-wrap: wrap; align-items: center;'>";
                        echo "<span><strong>Dátum:</strong> " . date('m-d H:i', $period['dt']) . "</span>";
                        echo "<span><strong>Hőm:</strong> " . round($period['main']['temp']) . "°C</span>";
                        echo "<span><strong>Időjárás:</strong> " . $period['weather'][0]['description'] . "</span>";
                        echo "<span><strong>Pára:</strong> " . $period['main']['humidity'] . "%</span>";
                        echo "<span><strong>Szél:</strong> " . $period['wind']['speed'] . " m/s</span>";
                        echo "<img src=\"https://openweathermap.org/img/w/" . $icon . ".png\" class=\"weather-icon\" />";
                        echo "</div>";
                    }
                } else {
                    echo "Nincs adat.";
                }
            ?>
        </div>
    </div>

    <div class="emptiness"></div>

    <h1>A következő napokban várható időjárás itt: <?= $cityName ?></h1>

    <div class="forecast-container">
        <div class="forecast-content">
            <?php
                if (!empty($dailyForecast)){
                    foreach ($dailyForecast as $period) {
                        echo "<div style='border:1px solid #ccc; margin:5px; padding:10px; display: flex; gap: 15px; flex-wrap: wrap; align-items: center;'>";
                        echo "<span><strong>Dátum:</strong> " . $period['date'] . "</span>";
                        echo "<span><strong>Min hőm:</strong> " . round($period['min']) . "°C</span>";
                        echo "<span><strong>Max hőm:</strong> " . round($period['max']) . "°C</span>";
                        echo "<img src=\"https://openweathermap.org/img/w/" . $period['icon'] . ".png\" class=\"weather-icon\" />";
                        echo "</div>";
                    }
                } else {
                    echo "Nincs adat.";
                }
            ?>
        </div>
    </div>

    <?php if (isset($_COOKIE['role']) && $_COOKIE['role'] === 'admin'): ?>
        <form class="export-form" action="..\export.php" method="post">
            <input type="submit" value="Exportálás">
        </form>
    <?php endif; ?>
</body>
</html>