<?php

    /**
     * Fetches files in JSON format
     * using PHP's JSON extension.
     * 
     * You must pass 'user' as uuid in the request field
     *    and the current password 'confirm'
     *    and the new password 'update'
     */


    require_once('../database.php');
    
    // Create connection
    $connection = dbConnect();
    
    //prepare sql
    $sql=sprintf("SELECT * from users where id='%s' AND password=PASSWORD('%s')",
    				$connection->real_escape_string($_REQUEST["user"]),
    				$connection->real_escape_string($_REQUEST["confirm"]));
    
    //execute query
    $result=$connection->query($sql) or die(mysqli_error($connection));
    
    //check whether we found a row
    if($result->num_rows==1){

    	// Change the password then
    	$sql=sprintf("UPDATE users SET password = PASSWORD('%s') WHERE id='%s';",
    				$connection->real_escape_string($_REQUEST["update"]),
    				$connection->real_escape_string($_REQUEST["user"]));
    				
    	//execute query
        $result=$connection->query($sql) or die(mysqli_error($connection));
    	
    	// Return truee
    	die('true');
    	
    }
    else{
        die('fail');
    }
?>