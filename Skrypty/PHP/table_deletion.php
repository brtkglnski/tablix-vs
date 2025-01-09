<?php
require 'config.php';

$table_name = $_POST['deletion_name'] ?? '';

if (empty($table_name)) {
    die("Wymagana jest nazwa tablicy.");
}

mysqli_begin_transaction($connection);

try {
    $drop_table_query = "DROP TABLE IF EXISTS `$table_name`";
    if (!mysqli_query($connection, $drop_table_query)) {
        throw new Exception("Błąd przy usuwaniu '$table_name': " . mysqli_error($connection));
    }
    $delete_query = "DELETE FROM metadata WHERE table_name = ?";
    $delete_statement = $connection->prepare($delete_query);
    $delete_statement->bind_param("s", $table_name);
    if (!$delete_statement->execute()) {
        throw new Exception("Błąd przy usuwaniu: " . $delete_statement->error);
    }

    mysqli_commit($connection);
    echo "Metadane oraz tablica `$table_name` usunięte.";
} catch (Exception $e) {
    mysqli_rollback($connection);
    echo "Błąd: " . $e->getMessage();
}

if (!empty($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Przesłano formularz.";
}
?>