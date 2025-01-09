<?php
require 'config.php';

$icon_id = $_POST['icon_id'] ?? '';
$table_name = $_POST['table_name'] ?? '';
$source = $_POST['source'] ?? '';


mysqli_begin_transaction($connection);

try {
    $query = "INSERT INTO metadata (table_name, icon_id, source) VALUES (?,?,?)";
    $statement = $connection->prepare($query);
    $statement->bind_param("sss", $table_name, $icon_id, $source);

    if (!$statement->execute()) {
        throw new Exception("Błąd: " . mysqli_error($connection));
    }

    $metadata_id = mysqli_insert_id($connection); 

    $create_table_query = "CREATE TABLE `$table_name` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        metadata_id INT NOT NULL,
        name VARCHAR(80) NOT NULL,
        data INT NOT NULL,
        FOREIGN KEY (metadata_id) REFERENCES metadata(id) ON DELETE CASCADE
    )";

    if (!mysqli_query($connection, $create_table_query)) {
        throw new Exception("Niepowodzenie przy tworzeniu tabeli: " . mysqli_error($connection));
    }

    mysqli_commit($connection);
    echo "Dodano metadane, tabela `$table_name` została stworzona.";
} catch (Exception $e) {
    mysqli_rollback($connection);
    echo "Transakcja nieudana: " . $e->getMessage();
}

if (!empty($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Przesłano formularz.";
}
?>