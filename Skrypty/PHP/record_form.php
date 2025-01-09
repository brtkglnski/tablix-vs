<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $record_name = $_POST['name'] ?? '';
    $record_value = $_POST['data'] ?? '';
    $table_name = $_POST['table_name'] ?? '';

    if (empty($record_name) || empty($record_value) || empty($table_name)) {
        die("Błąd - brakuje danych");
    }

    $metadata_query = "SELECT id FROM metadata WHERE table_name = '$table_name'";
    $metadata_result = mysqli_query($connection, $metadata_query);

    if ($metadata_result && mysqli_num_rows($metadata_result) > 0) {
        $metadata_row = mysqli_fetch_assoc($metadata_result);
        $metadata_id = $metadata_row['id'];

        $insert_query = "INSERT INTO `$table_name` (`name`, `data`, `metadata_id`) VALUES ('$record_name', '$record_value', '$metadata_id')";

        if (mysqli_query($connection, $insert_query)) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            die("Błąd: " . mysqli_error($connection));
        }
    } else {
        die("Niepoprawna nazwa tabeli - nie znaleziono metadanych");
    }
}
?>
