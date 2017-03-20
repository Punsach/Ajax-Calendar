
<?php 
header("Content-Type: application/json");
require 'caldatabase.php';


if(isset($_POST['username'])){                        
    $user = htmlentities($_POST['username']);
    $pwd_guess = htmlentities($_POST['password']);
// Use a prepared statement

        $stmt = $mysqli->prepare("SELECT COUNT(*), username, password FROM users WHERE username=?");

// Bind the parameter      
        $stmt->bind_param('s', $user);
        $stmt->execute();
// Bind the results
        $stmt->bind_result($cnt, $username, $pwd_hash);//if count = 0, user dne
        $stmt->fetch();
        
            
         //Verify password and set up token
        if(password_verify($pwd_guess, $pwd_hash)){ 
            ini_set("session.cookie_httponly", 1);       
            session_start();
            $_SESSION['user_id'] = $user;
            $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
            $token = $_SESSION['token'];
               
                
                echo json_encode(array(
                    "success" => true,
                    "message" =>"Welcome, $user.",
                    "token" => $token
                ));
                exit;
            }else{
                echo json_encode(array(
                    "success" => false,
                    "message" => "Incorrect Username or Password"
                ));
                exit;
            } 
            
        }

        ?>