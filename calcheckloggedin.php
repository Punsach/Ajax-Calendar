<?php
header("Content-Type: application/json");
if (isset($_SESSION['user_id'])){  
	echo json_encode(array(
		"success" => true));
	}
else{
	echo json_encode(array(
 		"success" => false));
}

?>