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
        <form class="search-input">
            <input type="text" placeholder="Keresés">
            <input type="submit">
        </form>
    </div>
    
    <h1>Előrejelzés</h1>

    <div class="forecast-container">
        <div class="forecast-content">
            <?= $homerseklet ?>
            <?= $egbolt ?>
            <?= $max ?>
            <?= $min ?>
            <?= $csapadek ?>
        </div>
    </div>

    <div class="emptiness"></div>

    <div class="forecast-container">
        <div class="forecast-content">
            <?= $homerseklet ?>
            <?= $egbolt ?>
            <?= $max ?>
            <?= $min ?>
            <?= $csapadek ?>
        </div>
    </div>

</body>
</html>