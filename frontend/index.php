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

        <form action="login.html">
            <button type="submit">Bejelentkezés</button>
        </form>
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