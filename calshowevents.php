<?php
	header("Content-Type: application/json");
    require 'caldatabase.php';   
    session_start();              
    $user = $_SESSION['user_id'];
    $date = $_POST['date'];
   	//$user = "user1";
    $stmt = $mysqli->prepare("select id, time, title from events where user = '$user' and date = '$date'");
    if(!$stmt)
    {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $stmt->bind_result($id, $time, $title); 	
	while($row = $stmt->fetch()){
  		$json[]['id'] = $id;
  		//$json[]['date'] = $date;
  		$json[]['time'] = $time;
  		$json[]['title'] = $title;
	}
	echo json_encode($json);   
   $stmt->close();



?>