<?php

include('db-connection.php');

$error = "";

function trim_value(&$value) {
    $value = trim($value);  
}
array_filter($_POST, 'trim_value');
$postFilter =    
    array(
        'mic'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW),    
        'username'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW),
        'platform'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW),
        'activity'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW),
        'gametype'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW),
    );
$lfgData = filter_var_array($_POST, $postFilter);  

$username = $lfgData[username];
$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
$username = mysqli_real_escape_string($link, $username);

if (preg_match('/^[A-Za-z0-9-_\s]+$/', $username)) {
    //echo 'GamerTag is legit. ';
} else {
    $error .= "Improper GamerTag. ";
}

$platform = $lfgData[platform];
switch ($platform) {
    case "psn":
        $platform = "psn";
    break;
case "xbox":
        $platform = "xbox";
    break;
case "pc":
        $platform = "pc";
    break;
default:
        $platform = "none";    
        $error .= "No platform set. ";
}

$gametype = $lfgData[gametype];
switch ($gametype) {
    case "Creative":
        $gametype = "Creative";
    break;
    case "Normal":
        $gametype = "Normal";
    break;
    case "Survival":
        $gametype = "Survival";
    break;
    case "Permadeath":
        $gametype = "Permadeath";
    break;
    default:
        $gametype = "No Gametype Set. ";    
        $error .= "No Gametype Set. ";
}

$mic = $lfgData[mic];
switch ($mic) {
    case "true":
        $mic = "true";
    break;
    case "false":
        $mic = "false";
    break;
    default:
        $mic = "error";
        $error .= "Mic neither true or false! ";
}

$activity = $lfgData[activity];
switch ($activity) {
    case "Anything":
        $activity = "Anything";
    break;
    case "Missions":
        $activity = "Missions";
    break;
    case "Base Building":
        $activity = "Base Building";
    break;
    case "Story":
        $activity = "Story";
    break;
    case "Battle":
        $activity = "Battle";
    break;
    case "Explore":
        $activity = "Explore";
    break;
    default:
        $activity = "-- error";    
        $error .= "No activity chosen! ";
}

require('banwords.php');
$censor = new CensorWords;
$censor->setReplaceChar(",");
$langs = array('cs','de','en-base','en-us', 'en-uk', 'es', 'fi', 'fr', 'it', 'jp','kr','nl','no');
$badwords = $censor->setDictionary($langs);
$string = $censor->censorString($username);
$username = $string[clean];


if(strpos($username, ",") === false) {
    if (strlen($username) > 40 || $username == "undefined") {
        $username= substr($username, 0, 47) . '...';
        $error .= "Too long username! ";
    }
    if ($username == ""){
        $error .= "No username provided. ";
    }
    if ($username == "undefined") {
        $error .= "No username supplied. ";
    }    
} else {
    $error .= "Username has profanity :( ";
}

echo ($error === "" ? "\"".$username."\" –  Gamertag ok!" : $error );