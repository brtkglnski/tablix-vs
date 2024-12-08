<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "tablix_vs";
$table = "metadata";

$connection = mysqli_connect($server, $username, $password);

if(!$connection){
    die("Połączenie nieudane: " . mysqli_connect_error());
}

$db_query = "CREATE DATABASE IF NOT EXISTS `$database`;";
if(!mysqli_query($connection, $db_query)){
    die("Tworzenie bazy danych nieudane: " . mysqli_error($connection));
}

mysqli_close($connection);

$connection = mysqli_connect($server, $username, $password, $database);

$table_query = "CREATE TABLE IF NOT EXISTS `$table` (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    table_name VARCHAR(50) NOT NULL,
    icon_id VARCHAR(100) NOT NULL,
    source ENUM('Custom', 'Spotify') NOT NULL
    );";
    if(!mysqli_query($connection, $table_query)){
        die("Tworzenie tabeli nieudane: " . mysqli_error($connection));
    }
?>