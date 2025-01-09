<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $record_name = $_POST['record_name'] ?? '';
    $table_name = $_POST['table_name'] ?? '';
    
    if (empty($record_name)) {
        die("Nie podano nazwy rekordu.");
    }

    if (empty($table_name)) {
        die("Nie podano nazwy tablicy. ");
    }

    $delete_query = "DELETE FROM `$table_name` WHERE `name` = '$record_name'";

    if (mysqli_query($connection, $delete_query)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        die("Bład przy usuwaniu: " . mysqli_error($connection));
    }
}
?>
