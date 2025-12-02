<?php
    require_once '..\backend.php';
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
    </div>

    <div class="header">
        <form class="search-input" action=""> <!-- az action-be kellene beleírni a keresés algoritmusát-->
            <input id="search-field" type="text">
            <input id="search-submit" type="submit" value="Keresés">
        </form>
    </div>
    
    <h1>Előrejelzés órákra bontva</h1>

    <div class="forecast-container">
        <div class="forecast-content">
            <p>Dátum</p>
            <?php
            // if ($currentForecast && isset($currentForecast['list'])){
            //     foreach ($currentForecast['list'] as $period) {
            //         echo "<div style='border:1px solid #ccc; margin:5px; padding:10px;'>";
            //         echo "<strong>Date/Time:</strong> " . date('Y-m-d H:i', $period['dt']) . "<br>";
            //         echo "<strong>Temp:</strong> " . $period['main']['temp'] . "°C<br>";
            //         echo "<strong>Weather:</strong> " . $period['weather'][0]['description'] . "<br>";
            //         echo "<strong>Humidity:</strong> " . $period['main']['humidity'] . "%<br>";
            //         echo "<strong>Wind:</strong> " . $period['wind']['speed'] . " m/s<br>";
            //         echo "</div>";
            //     }
            // } else {
            //     echo "Nincs adat.";
            // }
            ?>
        </div>
    </div>

    <div class="emptiness"></div>

    <h1>A következő napokban várható időjárás</h1>

    <div class="forecast-container">
        <div class="forecast-content">
            <p>Dátum</p>
            <?php
                if ($predictedForecast && isset($predictedForecast['list'])){
                foreach ($predictedForecast['list'] as $period) {
                    // Itt adtam hozzá a 'display: flex' és 'justify-content' stílusokat
                    // A 'gap: 15px' távolságot tart az elemek között
                    // Az 'align-items: center' középre igazítja őket függőlegesen
                    echo "<div style='border:1px solid #ccc; margin:5px; padding:10px; display: flex; gap: 15px; flex-wrap: wrap; align-items: center;'>";
                
                    // A <br> tageket töröltem, és span-okba tettem az adatokat a könnyebb formázásért
                    echo "<span><strong>Dátum:</strong> " . date('m-d H:i', $period['dt']) . "</span>";
                    echo "<span><strong>Hőm:</strong> " . round($period['main']['temp']) . "°C</span>";
                    echo "<span><strong>Időjárás:</strong> " . $period['weather'][0]['description'] . "</span>";
                    echo "<span><strong>Pára:</strong> " . $period['main']['humidity'] . "%</span>";
                    echo "<span><strong>Szél:</strong> " . $period['wind']['speed'] . " m/s</span>";
                
                    echo "</div>";
                }
                } else {
                    echo "Nincs adat.";
                }
            ?>
        </div>
    </div>

    <?php if (isset($_COOKIE['role']) && $_COOKIE['role'] === 'admin'): ?>
        <form class="export-form">
            <input type="submit" value="Exportálás">
        </form>
    <?php endif; ?>
</body>
</html>