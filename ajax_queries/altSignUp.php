<?php

    /*
    
    Used to validate an alternate sign with backend
    
    Must send id, email, username, and name
    
    */
    
    require_once('../database.php');
    
    session_start();
    $connection = dbConnect();

    $password= time() + $_REQUEST["id"];
    $id = $_REQUEST["id"];
	
	$sql = sprintf("Select 1 FROM users WHERE username = '%s'",
    $connection->real_escape_string($username));
            
    // execute query
    $result = $connection->query($sql) or die(mysqli_error($connection));           

    // check whether we found a row
    if ($result->num_rows == 0){
        addUser($connection,array('password' => $password,'username' => $username, 'email' => $email, 'name' => $name), $id);
    }
	
	$_SESSION['userName'] =  $_REQUEST["username"];
    $_SESSION['userUuid'] = $_REQUEST["id"];
    $_SESSION['password'] = null;
    $_SESSION['email'] = $_REQUEST["email"];
    $_SESSION['name'] = $_REQUEST["name"];
	
	return true;

?>