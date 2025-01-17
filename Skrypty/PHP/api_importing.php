<?php
require 'config.php';

$table_name = $_POST['table_name'] ?? '';

// Function to get Spotify access token
function getSpotifyAccessToken($clientId, $clientSecret) {
    // Initialize cURL for making a POST request to Spotify's token endpoint
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

// Function to fetch playlist data
function getPlaylistData($playlistId, $accessToken) {
    // Initialize cURL for making a GET request to Spotify's playlist endpoint
    $ch = curl_init("https://api.spotify.com/v1/playlists/$playlistId/tracks");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer $accessToken"]);
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);
    return $response;
}

// Get the playlist URL from the form submission
$playlistUrl = $_POST['playlist_url'] ?? '';
$clientId = $_POST['client_id'] ?? ''; 
$clientSecret =  $_POST['client_secret'] ?? ''; 

// Validate and extract the playlist ID from the URL
if (!$playlistUrl || !preg_match('/playlist\/([a-zA-Z0-9]+)/', $playlistUrl, $matches)) {
    echo "Invalid or missing playlist URL.";
    return;
}

$playlistId = $matches[1];
$accessToken = getSpotifyAccessToken($clientId, $clientSecret);

if (!$accessToken) {
    echo "Failed to authenticate with Spotify.";
    return;
}

$data = getPlaylistData($playlistId, $accessToken);

if (empty($data['items'])) {
    echo "No tracks found in the playlist.";
    return;
}

$metadata_query = "SELECT id FROM metadata WHERE table_name = ?";
$metadata_stmt = $connection->prepare($metadata_query);
$metadata_stmt->bind_param("s", $table_name);
$metadata_stmt->execute();
$metadata_result = $metadata_stmt->get_result();


if (!$metadata_result || mysqli_num_rows($metadata_result) === 0) {
    echo "Error finding table ID.";
    return;
}

$metadata_row = mysqli_fetch_assoc($metadata_result);
$metadata_id = $metadata_row['id'];

echo "<ul>";
foreach ($data['items'] as $item) {
    if (!isset($item['track']['name'], $item['track']['popularity'], $item['track']['artists'][0]['name'])) {
        echo "<li>Track data missing</li>";
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







