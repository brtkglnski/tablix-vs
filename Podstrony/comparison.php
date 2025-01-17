<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>
        <?php
             if (isset($_GET['table_name'])) {
            $table_name = $_GET['table_name'];
            echo $table_name;
             }
             ?>
             </title>
</head>
<body>
        <main class="mainGameLayout">
       <div class="leftOption">
        <p>x</p>
       </div>
       <div class="rightOption">
        <p>x</p>
       </div>
       <div class="returnButton top-left">
        <svg><use href="../Zasoby/SVG/icons.svg#close-icon"></svg>
       </div> 
        <div class="currentScore top-right">
        <p>0</p><svg class="textSVG"><use href="../Zasoby/SVG/icons.svg#plus-icon"></svg>
       </div>
       <div class="selectedPopUp">
       <div class="endingScreen">
        <span class="scoreInfo">
        <h1>
            <?php
             if (isset($_GET['table_name'])) {
            $table_name = $_GET['table_name'];
            echo $table_name;
             }
             ?>
             </h1>
        <p id="currentScore">Wynik: </p>
        <p id="topScore">Najlepszy wynik: </p>
            </span>
        <div class="fullwidthButtons">
        <button class="primaryButton" onclick="playAgain(); return false;">Zagraj ponownie</button>
        <button class="primaryButton" onclick="exit(); return false;">Wyjdź</button>
</div>
       </div>
            </div>
        </main>


    <script src="../Skrypty/JS/comparison.js"></script>
</body>
</html>