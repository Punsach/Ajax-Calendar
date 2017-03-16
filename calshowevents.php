<?php
	header("Content-Type: application/json");
     require 'caldatabase.php';                 
    $user = htmlentities($_POST['username']); ////////NEED TO CHANGE TO SESSION VAR////////
   	//$user = "user1";
    $stmt = $mysqli->prepare("select id, date, time, title from events where user = '$user'");
    if(!$stmt)
    {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($id, $date, $time, $title); 	
	while($row = $stmt->fetch()){
  		$json[]['id'] = $id;
  		$json[]['date'] = $date;
  		$json[]['time'] = $time;
  		$json[]['title'] = $title;
	}
	echo json_encode($json);   
   $stmt->close();



?>