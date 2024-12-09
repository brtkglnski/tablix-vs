<?php
require 'config.php';

$table_name = $_POST['deletion_name'] ?? '';

if (empty($table_name)) {
    die("The table name is required for deletion.");
}

mysqli_begin_transaction($connection);

try {
    $drop_table_query = "DROP TABLE IF EXISTS `$table_name`";
    if (!mysqli_query($connection, $drop_table_query)) {
        throw new Exception("Error deleting child table `$table_name`: " . mysqli_error($connection));
    }

    $delete_query = "DELETE FROM metadata WHERE table_name = ?";
    $delete_statement = $connection->prepare($delete_query);
    $delete_statement->bind_param("s", $table_name);
    if (!$delete_statement->execute()) {
        throw new Exception("Error deleting metadata: " . $delete_statement->error);
    }

    // Commit transaction
    mysqli_commit($connection);
    echo "Metadata entry and child table `$table_name` deleted successfully.";
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