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
	
	$sql = sprintf("Select * FROM users WHERE id = '%s'",
    $connection->real_escape_string($id));
            
    // execute query
    $result = $connection->query($sql) or die(mysqli_error($connection));           

    // check whether we found a row
    if ($result->num_rows == 0){
        addUser($connection,array('password' => $password,'username' => $_REQUEST["username"], 'email' => $_REQUEST["email"], 'name' => $_REQUEST["name"]), $id);
    }
    else{
        $row = mysqli_fetch_assoc($result);
        $_SESSION['pro'] = $row['pro'];
    }
	
	$_SESSION['userName'] =  $_REQUEST["username"];
    $_SESSION['userUuid'] = $_REQUEST["id"];
    $_SESSION['password'] = null;
    $_SESSION['email'] = $_REQUEST["email"];
    $_SESSION['name'] = $_REQUEST["name"];
	
	return true;

?>