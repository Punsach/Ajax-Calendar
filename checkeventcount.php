<?php

	header("Content-Type: application/json");
    require 'caldatabase.php';   
    session_start();    
    if (isset($_SESSION['user_id'])){          
        $user = $_SESSION['user_id'];              
        //$user = "user1";
        $date = htmlentities($_POST['date']);
        
        ////Checks whether filtering by important tag
        $important = $_POST['important'];

        if($important!=0){
            $stmt = $mysqli->prepare("select COUNT(*) from events where date = '$date' and user = '$user' and important = 1"); //only selects important events
            if(!$stmt)
            {
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
            }
            $stmt->execute();
            $stmt->bind_result($count);     
            $stmt->fetch();
            echo $count;    
            $stmt->close();
            }
        else{
        $stmt = $mysqli->prepare("select COUNT(*) from events where date = '$date' and user = '$user'");
        if(!$stmt)
        {
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        }
        $stmt->execute();
        $stmt->bind_result($count); 	
    	$stmt->fetch();
    	echo $count;    
       	$stmt->close();
       }
 }
?>