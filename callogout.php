<?php
	//logs out user, destroying session
	session_start();
    session_unset();
    session_destroy();
    
?>