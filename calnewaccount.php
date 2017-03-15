
<?php 
header("Content-Type: application/json");
require 'caldatabase.php';
if(isset($_POST['new_username'])){                        
	$username = htmlentities($_POST['new_username']);
	$password = htmlentities($_POST['new_password']);
	$hashedpassword = password_hash($password,PASSWORD_DEFAULT);
// Use a prepared statement
	$stmt = $mysqli->prepare("insert into users (username,password ) values ('$username', '$hashedpassword')");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->execute();	
	$stmt->close();
	echo json_encode(array(
		"success" => true
		"message" => "Registration successful, log in"
		));
	exit;
}    
else{
	echo json_encode(array(
		"success" => false,
		"message" => "Can't Register"
		));
	exit;
}

?>