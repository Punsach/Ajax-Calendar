<?php
	header("Content-Type: application/json");
     require 'caldatabase.php';                 
    $user = htmlentities($_POST['username']); 
   	//$user = "user1";
    $stmt = $mysqli->prepare("select id, date, time, title from events where user = '$user'");
    if(!$stmt)
    {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();

    $stmt->bind_result($id, $date, $time, $title); 

	// while($stmt->fetch()){
	// 	$json .= '{"'.$id.'":
	// 		{"date":"'.$date.'",
	// 		"time":"'.$time.'",
	// 		"title":"'.$title.'"},';


	// }
	 // $json = substr($string, 0, -1);
	 // $json .= '}'."'";
	while($row = $stmt->fetch()){
  		$json[]['id'] = $id;
  		$json[]['date'] = $date;
  		$json[]['time'] = $time;
  		$json[]['title'] = $title;
	}
	// while($stmt->fetch()){
		
	// }
	//$json .= "hi";
	//$json = '{"apple":{"color":"red","flavor":"sweet"},"lemon":{"color":"yellow","flavor":"sour"}}';
	//$json = "$user";
	echo json_encode($json);
	//end citation
    
   $stmt->close();



?>