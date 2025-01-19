<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Modyfikowanie tabeli</title>
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
<body  class="grid">
            <div class="returnButton top-left">
        <a href="../index/index.php"><svg><use href="../Zasoby/SVG/icons.svg#close-icon"></svg></a>
       </div> 
       <div class="returnButton top-right topRightTranslate">
        <a href="../Podstrony/api-importing.php?table_name=<?php
             if (isset($_GET['table_name'])) {
            $table_name = $_GET['table_name'];
            echo $table_name;
             }?>"
            ><svg><use href="../Zasoby/SVG/icons.svg#spotify-icon"></svg></a>
       </div> 
    <header>
        <img src="../Zasoby/Obrazy/tablix_logo.png">
        </header>
        <main class="inputLayout"> 
        <div class="formBackground">

            <h1 id="databaseTitle">        
            <?php
             if (isset($_GET['table_name'])) {
            $table_name = $_GET['table_name'];
            echo $table_name;
             }
            ?>
            </h1>
    <table class="dataTable">
    <thead>
        <tr class="tableHeader">
            <th class="tableHeaderCell">Nazwa</th>
            <th class="tableHeaderCell">Wartość</th>
        </tr>
    </thead>
    <tbody>
    <tr class="tableRow">
                    <form action="../Skrypty/PHP/record_form.php" method="POST" id="additionForm">
                        <td class="tableCell">
                            <input class="inputField" type="text" id="name" name="name" maxlength="80" required>
                        </td>
                        <td class="tableCell">
                            <input class="inputField" type="number" id="data" name="data" required>
                        </td>
                        <td class="tableCell">
                            <button type="submit" class="addEntryButton" id="addEntryButton">Dodaj</button>
                            <input type="hidden" name="table_name" id="tableAdditionInput" value="">
                        </td>
                    </form>
                </tr>
        <?php
        if (isset($_GET['table_name'])) {
            $table_name = $_GET['table_name'];

            $sql = "SELECT * FROM `$table_name`";  
            $result = mysqli_query($connection, $sql);

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr class='tableRow'>";
                    echo "<td class='tableCell'>" . $row["name"] . "</td>";
                    echo "<td class='tableCell'>" . $row["data"] . "</td>";
                    echo "<td class='tableCell'><button action='' class='deleteEntryButton'><svg><use href='../Zasoby/SVG/icons.svg#trashcan-icon'></use></svg></button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td class='tableCell' colspan='3'>Error: " . mysqli_error($connection) . "</td></tr>";
            }
        } else {
            echo "<tr><td class='tableCell' colspan='3'>No table name provided.</td></tr>";
        }
        ?>
    </tbody>
</table>
<form id="deletionForm" action="../Skrypty/PHP/record_deletion.php" method="POST">
                    <input type="hidden" name="record_name" id="recordNameInput" value="">
                    <input type="hidden" name="record_value" id="recordValueInput" value="">
                    <input type="hidden" name="table_name" id="tableInput" value="">
                </form>
</div>
        </main>
    <footer>
        <div class="footerSection">
            <h3>INFORMACJE</h3>
            <p class="footerElement">Strona stworzona w ramach projektu semestralnego.</p>
        </div>

        <div class="footerSection">
            <h3>O PROJEKCIE</h3>
            <a href="../Zasoby/Dokumenty/Tablix - Dokumentacja Użytkownika.pdf" download class="footerElement footerLink">
                dokumentacja użytkownika <svg class="textSVG"><use href="../Zasoby/SVG/icons.svg#download-icon"/></svg> 
            </a>
            <a href="../Zasoby/Dokumenty/Tablix - Dokumentacja Techniczna.pdf" download class="footerElement footerLink">
                dokumentacja techniczna <svg class="textSVG"><use href="../Zasoby/SVG/icons.svg#download-icon"/></svg> 
            </a>
            <br>
        </div>

        <div class="footerSection">
            <h3>PODSTRONY</h3>
            <a href="../index/index.php" class="footerElement footerLink">strona główna</a><br>
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
    <script src="../Skrypty/JS/modify-table.js"></script>
</body>
</html>