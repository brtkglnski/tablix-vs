<?php
require 'config.php';

$table_name = $_POST['table_name'] ?? '';

function getSpotifyAccessToken($clientId, $clientSecret) {
    $ch = curl_init("https://accounts.spotify.com/api/token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Basic " . base64_encode("$clientId:$clientSecret"),
        "Content-Type: application/x-www-form-urlencoded" 
    ]);
    $response = json_decode(curl_exec($ch), true); 
    curl_close($ch);
    return $response['access_token'] ?? null;
}

function getPlaylistData($playlistId, $accessToken) {
    $ch = curl_init("https://api.spotify.com/v1/playlists/$playlistId/tracks");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $accessToken"]);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $response;
}

$playlistUrl = $_POST['playlist_url'] ?? '';
$clientId = $_POST['client_id'] ?? ''; 
$clientSecret =  $_POST['client_secret'] ?? ''; 

if (!$playlistUrl || !preg_match('/playlist\/([a-zA-Z0-9]+)/', $playlistUrl, $matches)) {
    echo "Niepoprawny URL playlisty.";
    return;
}

$playlistId = $matches[1];
$accessToken = getSpotifyAccessToken($clientId, $clientSecret);

if (!$accessToken) {
    echo "Autoryzacja nieudana.";
    return;
}

$data = getPlaylistData($playlistId, $accessToken);

if (empty($data['items'])) {
    echo "Nie znaleziono utworów w playliście.";
    return;
}

$metadata_query = "SELECT id FROM metadata WHERE table_name = ?";
$metadata_stmt = $connection->prepare($metadata_query);
$metadata_stmt->bind_param("s", $table_name);
$metadata_stmt->execute();
$metadata_result = $metadata_stmt->get_result();


if (!$metadata_result || mysqli_num_rows($metadata_result) === 0) {
    echo "Nie znaleziono ID tabeli.";
    return;
}

$metadata_row = mysqli_fetch_assoc($metadata_result);
$metadata_id = $metadata_row['id'];

echo "<ul>";
foreach ($data['items'] as $item) {
    if (!isset($item['track']['name'], $item['track']['popularity'], $item['track']['artists'][0]['name'])) {
        echo "<li>Brak danych utworu</li>";
        continue;
    }

    $record_name = $item['track']['name']." - ".$item['track']['artists'][0]['name'];
    $record_value = $item['track']['popularity'];
    $insert_query = "INSERT INTO `$table_name` (`name`, `data`, `metadata_id`) VALUES (?, ?, ?)";
$insert_stmt = $connection->prepare($insert_query);
$insert_stmt->bind_param("sii", $record_name, $record_value, $metadata_id);
$insert_stmt->execute();
}
$redirectUrl = "../../Podstrony/modify-table.php?table_name=" . $table_name;
header("Location: $redirectUrl");
echo "</ul>";







