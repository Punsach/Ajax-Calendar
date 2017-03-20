<?php
require 'caldatabase.php';
$user = htmlentities($_POST['user']);
$id = $_POST['id'];

$stmt = $mysqli->prepare("select COUNT(*) from users where username = '$user'"); //checking if user exists
if(!$stmt)
{
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();
$stmt->bind_result($count);     
$stmt->fetch();
$stmt->close();

if ($count == 1){
	$stmt = $mysqli->prepare("select date, time, title from events where id = $id"); //gets data for event to be shared
	if(!$stmt)
	{
		printf("Query 1 Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->execute();
	$stmt->bind_result($date, $time, $title); //saves event details
	$stmt->fetch();
	$stmt->close();

	$stmt = $mysqli->prepare("insert into events (user, date,time, title ) values ('$user', '$date', '$time', '$title')"); //sharing event with the specified user
	if(!$stmt){
		printf("Query 2 Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->execute();	
	$stmt->close();
}   


?>