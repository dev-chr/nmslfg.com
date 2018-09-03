<?php 
date_default_timezone_set('America/New_York');
$link = mysqli_connect("localhost", "dbname", "dbpw", "dbuser");

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

?>


