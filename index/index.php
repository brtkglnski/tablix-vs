<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wybór kategorii</title>
    <link rel="stylesheet" href="../Style/style.css">
</head>
<?php 
require '../Skrypty/PHP/config.php';
$server = "localhost";
$username = "root";
$password = "";
$database = "tablix_vs";
$table = "metadata";

$connection = mysqli_connect($server, $username, $password, $database);
if(!$connection){
    die("Połączenie nieudane: " . mysqli_connect_error());
}
?>
<body>
    <div class="selectedPopUp" id="selectedPopUp">

        <div class="tableActionMenu tableMenu" id="tableActionMenu">
            <svg class="okladkaOpcji" id="svg"><use href="../Zasoby/SVG/icons.svg#database-icon"></use></svg>
            <p class="actionMenuTitle" id="actionMenuTitle">tytul</p>
            <button action="" class="actionMenuAbsoluteButton delete"><svg><use href="../Zasoby/SVG/icons.svg#trashcan-icon"></svg></button>
                <button class="actionMenuAbsoluteButton exit"><svg><use href="../Zasoby/SVG/icons.svg#close-icon"></svg></button>
            <div class="actionMenuButtons"><button class="primaryButton">Graj</button><button class="secondaryButton">Edytuj</button></div>
            <form id="deletionForm" action="../Skrypty/PHP/table_deletion.php" method="POST">
            <input type="hidden" name="deletion_name" id="deletionInput" value="">
            </form>
        </div>

        <div class="tableCreationMenu tableMenu" id="tableCreationMenu">

            <label for="svg">Wybierz ikonę</label>
            <svg class="okladkaOpcji iconSelection" id="svg" form="tableForm"><use href="../Zasoby/SVG/icons.svg#plus-icon"></use></svg>
            <div class="okladkaOpcji iconSelectionMenu">
                <svg class="iconOption"><use name="icon_id" value="heart-icon" href="../Zasoby/SVG/icons.svg#heart-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="star-icon" href="../Zasoby/SVG/icons.svg#star-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="controller-icon" href="../Zasoby/SVG/icons.svg#controller-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="speed-icon" href="../Zasoby/SVG/icons.svg#speed-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="bolt-icon" href="../Zasoby/SVG/icons.svg#bolt-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="person-icon" href="../Zasoby/SVG/icons.svg#person-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="weight-icon" href="../Zasoby/SVG/icons.svg#weight-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="globe-icon" href="../Zasoby/SVG/icons.svg#globe-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="cloud-icon" href="../Zasoby/SVG/icons.svg#cloud-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="finance-icon" href="../Zasoby/SVG/icons.svg#finance-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="bar-chart-icon" href="../Zasoby/SVG/icons.svg#bar-chart-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="internet-globe-icon" href="../Zasoby/SVG/icons.svg#internet-globe-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="spotify-icon" href="../Zasoby/SVG/icons.svg#spotify-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="database-icon" href="../Zasoby/SVG/icons.svg#database-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="home-icon" href="../Zasoby/SVG/icons.svg#home-icon"/></svg>
                <svg class="iconOption"><use name="icon_id" value="github-icon" href="../Zasoby/SVG/icons.svg#github-icon"/></svg>
            </div>
            <div class="inputContainer">
            <label for="addTableName" class="addTableLabel">Nazwa tabeli</label>
            <input type="text" id="addTableName" form="tableForm" class="addTableName" name="table_name" placeholder="np. Waluty krajów Afryki" maxlength="50">
            </div>

            <button class="actionMenuAbsoluteButton exit"><svg><use href="../Zasoby/SVG/icons.svg#close-icon"></svg></button>

            <div class="actionMenuButtons">
            <button class="primaryButton submitting" type="submit" form="tableForm" name="source" value="Custom">Stwórz własną tabelę</button>
            <button class="secondaryButton submitting" type="submit" form="tableForm" name="source" value="Spotify">Importuj przez API</button>
            </div>
        </div>

        <form id="tableForm" action="../Skrypty/PHP/metadata_form.php" method="POST">
       <input type="hidden" name="icon_id" id="iconInput" value="">
       <input type="hidden" name="table_name" id="tableInput" value="">
       <input type="hidden" name="source" id="sourceInput" value="">
        </form>

    </div>
    <header>
    <img src="../Zasoby/Obrazy/tablix_logo.png">
    </header>
    <main>
    <div class="poleOpcji">
    <?php


$sql = "SELECT * FROM metadata;";
$result = mysqli_query($connection, $sql);  


if ($result) {
    while ($row = mysqli_fetch_array($result)) { 
        echo '<div class="Opcja '.$row["source"].'" id="Opcja">
                <svg class="okladkaOpcji" id="okladkaOpcji">
                    <use href="../Zasoby/SVG/icons.svg#'.$row["icon_id"].'"></use> 
                </svg>
                <p id="opisOpcji" class="opisOpcji">'.$row["table_name"].'</p>
              </div>';
    }
} else {
    echo "Error: " . mysqli_error($connection); 
}
?>
        <div class="Opcja dodaj"  id="Opcja">
            <svg class="okladkaOpcji" id="okladkaOpcji"><use href="../Zasoby/SVG/icons.svg#plus-icon"></svg><p id="opisOpcji" class="opisOpcji">Dodaj tabelę...</p>
        </div>
    </div>
</main>
    <footer>
        <div class="footerSection">
            <h3>INFORMACJE</h3>
            <p class="footerElement">Strona stworzona w ramach projektu semestralnego.</p>
        </div>

        <div class="footerSection">
            <h3>O PROJEKCIE</h3>
            <a href="xd" download class="footerElement footerLink">
                dokumentacja <svg class="textSVG"><use href="../Zasoby/SVG/icons.svg#download-icon"/></svg> 
            </a>
            <br>
        </div>

        <div class="footerSection">
            <h3>PODSTRONY</h3>
            <a href="../Podstrony/info.html" class="footerElement footerLink">info</a>
        </div>

        <div class="footerSection">
            <h3>KONTAKT</h3>
            <a href="https://github.com/brtkglnski" target="_blank" class="footerElement footerLink">
                <svg class="textSVG"><use href="../Zasoby/SVG/icons.svg#github-icon"/></svg> github
            </a>
            <br>
            <a href="mailto:bartosz.gli08@gmail.com" class="footerElement footerLink">
                <svg class="textSVG"><use href="../Zasoby/SVG/icons.svg#mail-icon"/></svg> mail
            </a>
        </div>
    </footer>
    <script src="../Skrypty/JS/index.js"></script>
</body>
</html>