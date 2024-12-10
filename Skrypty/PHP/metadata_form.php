<?php
require 'config.php';

$icon_id = $_POST['icon_id'] ?? '';
$table_name = $_POST['table_name'] ?? '';
$source = $_POST['source'] ?? '';

$missing = [];

if (empty($icon_id)) $missing[] = "icon_id";
if (empty($table_name)) $missing[] = "table_name";
if (empty($source)) $missing[] = "source";

if ($missing) die("The following fields are required: " . implode(", ", $missing));

mysqli_begin_transaction($connection);

try {
    $query = "INSERT INTO metadata (table_name, icon_id, source) VALUES (?,?,?)";
    $statement = $connection->prepare($query);
    $statement->bind_param("sss", $table_name, $icon_id, $source);

    if (!$statement->execute()) {
        throw new Exception("Error inserting metadata: " . mysqli_error($connection));
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
        throw new Exception("Error creating child table: " . mysqli_error($connection));
    }

    // Commit transaction
    mysqli_commit($connection);
    echo "Metadata added and child table `$table_name` created successfully.";
} catch (Exception $e) {
    mysqli_rollback($connection);
    echo "Transaction failed: " . $e->getMessage();
}

if (!empty($_SERVER['HTTP_REFERER'])) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "Form processed successfully. No referrer available to redirect.";
}
?>