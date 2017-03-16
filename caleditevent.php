<?php
header("Content-Type: application/json");
require 'caldatabase.php';
if(isset($_POST['id'])){                        
    //$user = htmlentities($_POST['username']);
    $id = $_POST['id'];
    $new_time = htmlentities($_POST['time']);
    $new_date = htmlentities($_POST['date']);
    $new_title = htmlentities($_POST['title']);
    // $stmt = $mysqli->prepare("select date,time,title from events where id=$id");
    // if(!$stmt)
    // {
    //     printf("Query Prep Failed: %s\n", $mysqli->error);
    //     exit;
    // }
    // $stmt->execute();
    // $stmt->bind_result($date, $time, $title);
    // while($stmt->fetch()){ 
    //     $currentevent = $mysqli->real_escape_string($content);
    // }
    // $stmt->close();


/////////STILL NEED to get token working/////////
    
       // if(!hash_equals($_SESSION['token'], $_POST['token'])){
       //      die("Request forgery detected");
       //  }

    //Updates the table with the new event 
    $stmt = $mysqli->prepare("UPDATE events SET date='$new_date', time='$new_time', title = '$new_title' where id='$id'");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();
    $stmt->close();
    
          
}

?>