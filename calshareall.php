<?php
ini_set("session.cookie_httponly", 1);
session_start();
require 'caldatabase.php';
$userto = htmlentities($_POST['user']);
$userfrom = $_SESSION['user_id'];
$array = array();


$stmt = $mysqli->prepare("select COUNT(*) from users where username = '$userto'"); //checking if user exists
if(!$stmt)
{
	printf("Query 1 Prep Failed: %s\n", $mysqli->error);
	exit;
}
$stmt->execute();
$stmt->bind_result($count);     
$stmt->fetch();
$stmt->close();
if ($count === 1){

    $stmt = $mysqli->prepare("select date, time, title from events where user = '$userfrom'"); //gets data for event to be shared
    if(!$stmt){
        printf("Query 2 Prep Failed: %s\n", $mysqli->error);
        exit;
    }
    $stmt->execute();
    $result = $stmt->get_result();
    while($row=$result->fetch_assoc()){
        $array[]=$row;
    }
    $stmt->close();
    foreach ($array as $key=>$value){
        $date = $value['date'];
        $time = $value['time'];
        $title = $value['title'];
        $stmt1 = $mysqli->prepare("insert into events (user, date,time, title ) values ('$userto', '$date', '$time', '$title')"); //sharing events with the specified user
        if(!$stmt1){
            printf("Query 3 Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt1->execute();   
        $stmt1->close();
    }
    // $stmt->bind_result($date, $time, $title); //saves event details
    // while($row = $stmt->fetch()){ //iterates through all events
    //     $array[$row] = $row;  

    // }
    // $stmt->close();
    //  $stmt1 = $mysqli->prepare("insert into events (user, date,time, title ) values ('$userto', '$date', '$time', '$title')"); //sharing events with the specified user
    //     if(!$stmt1){
    //         printf("Query 3 Prep Failed: %s\n", $mysqli->error);
    //         exit;
    //     }
    //     $stmt1->execute();   
    //     $stmt1->close();

}   

?>