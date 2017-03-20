<?php 
header("Content-Type: application/json");
require 'caldatabase.php';                      
	$title = htmlentities($_POST['event_title']);
	$date= $_POST['date'];
	$time = $_POST['time'];
	ini_set("session.cookie_httponly", 1);
	session_start();
	$user = $_SESSION['user_id'];
	$important = 0;
    if($_POST['important']==true){
        $important = 1;
    }
	//$user = "user1";
	
// Use a prepared statement
	$stmt = $mysqli->prepare("insert into events (user, date,time, title, important ) values ('$user', '$date', '$time', '$title', '$important')");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->execute();
	$stmt->close();

?>