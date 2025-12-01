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
            <p>
                <?php
                if ($data && isset($data->main)){
                    echo "<div class='temp'>" . $data->main->temp . "</div>";
                    echo "<div class='temp-max'>" . $data->main->temp_max . "</div>";
                    echo "<div class='temp-min'>" . $data->main->temp_min . "</div>";
                    echo "<div class='humidity'>" . $data->main->humidity . "</div>";
                } else {
                    echo "Nincs adat.";
                }
                ?>
            </p>
        </div>
    </div>

    <div class="emptiness"></div>

    <h1>A következő napokban várható időjárás</h1>

    <div class="forecast-container">
        <div class="forecast-content">
            <p>Dátum</p>
            <p>
                <?php
                if ($data && isset($data->main)){
                    echo "<div class='temp'>" . $data->main->temp . "</div>";
                    echo "<div class='temp-max'>" . $data->main->temp_max . "</div>";
                    echo "<div class='temp-min'>" . $data->main->temp_min . "</div>";
                    echo "<div class='humidity'>" . $data->main->humidity . "</div>";
                } else {
                    echo "Nincs adat.";
                }
                ?>
            </p>
        </div>
    </div>

    <?php if (isset($_COOKIE['role']) && $_COOKIE['role'] === 'admin'): ?>
        <form class="export-form">
            <input type="submit" value="Exportálás">
        </form>
    <?php endif; ?>
</body>
</html>