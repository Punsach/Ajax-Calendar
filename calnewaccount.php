
<?php 
header("Content-Type: application/json");
require 'caldatabase.php';
ini_set("session.cookie_httponly", 1);
session_start();
if(isset($_POST['new_username'])){      


	$username = htmlentities($_POST['new_username']);
	$password = htmlentities($_POST['new_password']);
	$hashedpassword = password_hash($password,PASSWORD_DEFAULT);



	$stmt = $mysqli->prepare("select COUNT(*) from users where username = '$username'"); //checking if user exists
	if(!$stmt)
	{
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->execute();
	$stmt->bind_result($count);     
	$stmt->fetch();
	$stmt->close();

	if($count===0){
// Use a prepared statement
	$stmt = $mysqli->prepare("insert into users (username,password ) values ('$username', '$hashedpassword')");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->execute();	
	// echo json_encode(array(
	// 	"success" => success,
	// 	"message" => "Can't Register"
	// 	));
	$stmt->close();
// 	echo json_encode(array(
// 		"success" => true
// 		"message" => "Registration successful, log in"
// 		));
// 	exit;
// }    
// else{
// 	echo json_encode(array(
// 		"success" => false,
// 		"message" => "Can't Register"
// 		));
// 	exit;
}

// else{
// 	echo json_encode(array(
// 		"success" => false,
// 		"message" => "Can't Register"
// 		));
// }
}
?>