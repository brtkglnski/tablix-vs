
<?php
require 'config.php';
$server = "localhost";
$username = "root";
$password = "";
$database = "tablix_vs";

$connection = mysqli_connect($server, $username, $password, $database);
if (!$connection) {
    die("Połączenie nieudane: " . mysqli_connect_error());
}

if (isset($_GET['table_name'])) {
    $table_name = $_GET['table_name'];
    $sql = "SELECT * FROM `$table_name` ORDER BY RAND() LIMIT 2";
    $result = mysqli_query($connection, $sql);

    $options = [];
    while ($row = mysqli_fetch_array($result)) {
        $options[] = $row;
    }

    if (count($options) === 2) {
        echo json_encode([
            'left' => $options[0],
            'right' => $options[1]
        ]);
    } else {
        echo json_encode(['error' => 'Za mało danych']);
    }
}

mysqli_close($connection);
?>
