<?php

    // include 'elorejelzes.php';
    require_once '..\backend.php'

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
            <p>Bejelentkezve adminként</p>
            <button onclick="document.cookie='role=; path=/; max-age=0'; window.location.reload();">Kijelentkezés</button>
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
                if ($data && isset($data->main)){
                    echo $data;
                    // echo $data->main->temp_min;
                    // echo $data->main->humidity;
                } else {
                    echo "Nincs adat.";
                }
            ?>
            </div>
    </div>

    <div class="emptiness"></div>

    <h1>A következő napokban várható időjárás</h1>

    <div class="forecast-container">
        <div class="forecast-content">
            <p>Dátum</p>
            <?php
                if ($data && isset($data->main)){
                    echo $data;
                    // echo $data->main->temp_min;
                    // echo $data->main->humidity;
                } else {
                    echo "Nincs adat.";
                }
            ?>
        </div>
    </div>

    <form class="export-form">
        <input type="submit" value="Exportálás">
    </form>

</body>
</html>