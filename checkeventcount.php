<?php

	header("Content-Type: application/json");
    require 'caldatabase.php';   
    session_start();              
    $user = $_SESSION['user_id'];              
    $date = htmlentities($_POST['date']);
  
    $stmt = $mysqli->prepare("select COUNT(*) from events where date = '$date' and user = '$user'");
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