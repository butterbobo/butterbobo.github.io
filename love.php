<?php

$myfile = fopen("location.txt", "w");
$txt = "Time: " . date('Y-m-d H:i:s') . "\n\nLocation: " . $_GET["lat"] . ", " . $_GET["long"] . "\n\nIP Address: " . $_SERVER["REMOTE_ADDR"] . "\n\nUser Agent: " . $_GET["uagent"] . $_SERVER["HTTP_USER_AGENT"];
fwrite($myfile, $txt);
fclose($myfile);
echo "Latitude: " . $latitude . "<br>";
echo "Longitude: " . $longitude . "<br>";
echo "User Agent: " . $userAgent . "<br>";

?>



