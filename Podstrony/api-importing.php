<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <title>Importowanie poprzez API</title>
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
<body class="grid">
    <header>
        <img src="../Zasoby/Obrazy/tablix_logo.png">
        </header>
        <main class="inputLayout"> 
        <form method="POST" action="../Skrypty/PHP/api_importing.php" class="formBackground importingForm">
    <div>Link do playlisty<br><input type="text" id="playlist_url" name="playlist_url" required class="inputField"></div><br>
    <div>clientId<br><input type="text" id="client_id" name="client_id" required class="inputField"></div><br>
    <div>clientSecret<br><input type="text" id="client_secret" name="client_secret" required class="inputField"></div>
    <input type="hidden" id="table_name" name="table_name" value="<?php $table_name = $_GET['table_name']; echo $table_name; ?>">
    <div class="fullwidthButtons"><button type="submit" class="primaryButton importingButton">Pobierz dane z playlisty</button>
    <button type="reset" class="secondaryButton importingButton_alt">Wyczyść</button></div>
</form>

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
            <a href="../index/index.php" class="footerElement footerLink">strona główna</a>
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
</body>
</html>