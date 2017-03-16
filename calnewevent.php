<?php 
header("Content-Type: application/json");
require 'caldatabase.php';

if(isset($_POST['event_title'])){                        
	$title = htmlentities($_POST['event_title']);
	$date= $_POST['date'];
	$time = $_POST['time'];
	session_start();
	$user = $_SESSION['user_id'];
	//$user = $_POST['user'];

	
// Use a prepared statement
	$stmt = $mysqli->prepare("insert into events (user, date,time, title ) values ('$user', '$date', '$time', '$title')");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->execute();	
	$stmt->close();
}
?>