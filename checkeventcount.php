<?php

	header("Content-Type: application/json");
    require 'caldatabase.php';                 
    $date = htmlentities($_POST['date']); ////////NEED TO CHANGE TO SESSION VAR////////
   	//$user = "user1";
    $stmt = $mysqli->prepare("select COUNT(*) from events where date = '$date'");
    if(!$stmt)
    {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($count); 	
	$stmt->fetch();
	echo $count;    
   	$stmt->close();
?>