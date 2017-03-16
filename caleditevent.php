<?php

require 'caldatabase.php';
if(isset($_POST['new'])){                        
    $user = htmlentities($_POST['username']);
    $id = $_POST['id']
    $new_time = htmlentities($_POST['new_time']);
    $new_date = htmlentities($_POST['new_date']);
    $stmt = $mysqli->prepare("select date,time,title from events where id=$id");
    if(!$stmt)
    {
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();

    $stmt->bind_result($date, $time, $title);

   

    while($stmt->fetch()){
  
        $currentevent = $mysqli->real_escape_string($content);
    }
    $stmt->close();


/////////STILL NEED to define editEvent, get session vars like token working/////////
    if (isset($_POST['editEvent'])){
       if(!hash_equals($_SESSION['token'], $_POST['token'])){
            die("Request forgery detected");
        }
    $newComment = $_POST['comment'];

    //Updates the table with the new comment 
    $stmt = $mysqli->prepare("UPDATE events SET 'date'='$new_date', 'time'='$new_time', 'title' = '$new_title') where id=$event_id");
    if(!$stmt){
        printf("Query Prep Failed: %s\n", $mysqli->error);
        exit;
    }

    $stmt->execute();

    $stmt->close();
    
}           
}

?>