<?php
	header("Content-Type: application/json");
  ini_set("session.cookie_httponly", 1);
  session_start(); 

  if (isset($_SESSION['user_id'])){
    require 'caldatabase.php';   
    $myArray = array();
    
    //$user = "user1";             
    $user = $_SESSION['user_id'];
    $date = $_POST['date'];
    
 
    ////Checks whether filtering by important tag
    $important = $_POST['important'];
    if($important!=0){
        $stmt = $mysqli->prepare("select id, time, title from events where date = '$date' and user = '$user' and important = 1"); //only selects important events
      if(!$stmt)
    {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $result = $stmt->get_result();
    //$stmt->bind_result($id, $time, $title);   
  while($row = $result->fetch_assoc()){
      $tempArray = $row;
      array_push($myArray, $tempArray);
  }
  //echo json_encode($myArray);
  echo json_encode($myArray);   
  $stmt->close();
        }
    else{

    $stmt = $mysqli->prepare("select id, time, title from events where user = '$user' and date = '$date'");
    if(!$stmt)
    {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $result = $stmt->get_result();
    //$stmt->bind_result($id, $time, $title); 	
	while($row = $result->fetch_assoc()){
  		$tempArray = $row;
      array_push($myArray, $tempArray);
	}
	//echo json_encode($myArray);
  echo json_encode($myArray);   
  $stmt->close();
}
}
   
?>