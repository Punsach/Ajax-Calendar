<?php
	///deleting an event based on its event id, self-explanatory
	header("Content-Type: application/json");
    require 'caldatabase.php'; 

    	$id = $_POST['id'];
   		$stmt = $mysqli->prepare("delete from events where id='$id'");
    	if(!$stmt)
    	{
        	printf("Query Prep Failed: %s\n", $mysqli->error);
        	exit;
    	}
    	$stmt->execute();    
   		$stmt->close();

?>