<?php 
require('usernameCleaner.php');

if ($error === "") {
    include('db-connection.php');

    $now = new DateTime();
    $time = $now->format('Y-m-d H:i:s');

    $hourPlus = new DateTime();
    $hourPlus->add(new DateInterval('PT1H30S'));
    $expiry = $hourPlus->format('Y-m-d H:i:s');

    $sql = "INSERT INTO `your-table` (id, username, platform, activity, time, expiry, mic, gametype) VALUES (NULL,'$username', '$platform', '$activity', '$time', '$expiry', '$mic', '$gametype')";

    if (mysqli_query($link, $sql)) {
         //echo "Record updated successfully";
    } else {
         //echo "Error updating record: " . mysqli_error($link);
    }
    echo "Posting created!";
    mysqli_close($link);
}