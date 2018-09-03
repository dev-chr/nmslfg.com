<?php 
    echo '<div class="listings">';

    include('db-connection.php');
    
    $result = mysqli_query($link, "SELECT * FROM lfg ORDER BY time DESC");    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            
            $start_date = new DateTime();
            $since_start = $start_date->diff(new DateTime($row[time]));
            
            echo "<img class=\"icon\" src=\"/images/".$row[platform].".jpg\" />";
            echo "<span style=\"font-size: 0.7em\">Game Type:</span> ".$row[gametype]."<br />";
            echo "<span style=\"font-size: 0.7em\">Username:</span> ".$row[username]."<br />";
            echo "<span style=\"font-size: 0.7em\">Activity:</span> ".$row[activity]."<br />";
            
            echo "<br />Posted ".$since_start->i." minutes ago.<br />";

            echo "<span style=\"font-size: 0.7em\">Microphone:</span> ";
            echo ($row[mic] == true ? "Yes" : "No");
            echo "<br />";
            
            

            echo "<hr />";
        }
    } else {
        echo "No one wants to play in a group right now. :(";
    }
    echo '</div>';
    $now = new DateTime();
    $currentTime = $now->format('Y-m-d H:i:s');
    mysqli_query($link, "DELETE FROM `your-table` WHERE '$currentTime' > expiry");
    mysqli_close($link);
?>