<?php

    include 'elorejelzes.php';

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
        <?php for ($i = 0; $i <= 30; $i++): ?>
            <div class="forecast-content">
                <p>Dátum</p>
                <p><?= $homerseklet ?></p>
                <p><?= $egbolt ?></p>
                <p><?= $max ?></p>
                <p><?= $min ?></p>
                <p><?= $csapadek ?></p>
            </div>
         <?php endfor; ?>
    </div>

    <div class="emptiness"></div>

    <h1>A következő napokban várható időjárás</h1>

    <div class="forecast-container">
        <?php for ($i = 0; $i <= 30; $i++): ?>
        <div class="forecast-content">
            <p>Dátum</p>
            <p><?= $homerseklet ?></p>
            <p><?= $egbolt ?></p>
            <p><?= $max ?></p>
            <p><?= $min ?></p>
            <p><?= $csapadek ?></p>
        </div>
        <?php endfor; ?>
    </div>

    <form class="export-form">
        <input type="submit" value="Exportálás">
    </form>

</body>
</html>