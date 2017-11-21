<?php

function dbConnect(){
    define("USER","administrator");
	define("PASS","cs372DBLogin");
	define("DB","docdashDB");
	
	//connect to DB
	$connection=new mysqli('rds-mysql-docdash.cza6uneofziy.us-west-2.rds.amazonaws.com:3306',USER,PASS,DB);
	
	if($connection->connect_error){
		die('Connect Error (' .$connection->connect_errno . ') '
			. $connection->connect_error);
	}
	
	return $connection;
}

function addUser($connection, $details){
    extract($details);
 
    $sql = sprintf("Select 1 FROM users WHERE username = '%s'",
    $connection->real_escape_string($username));
            
    // execute query
    $result = $connection->query($sql) or die(mysqli_error($connection));           

    // check whether we found a row
    if ($result->num_rows == 1)
    {
        echo "<script type='text/javascript'> alert(\"Username is already used!\"); </script>";
    }
    else
    {
        $sql = sprintf("INSERT INTO `users` VALUES (UUID(),'%s','%s', password('%s'),'%s',1,0,0,SYSDATE())",
                   $connection->real_escape_string($username),
                   $connection->real_escape_string($name),
                   $connection->real_escape_string($password),
                   $connection->real_escape_string($email));
        
        // execute query
        $result = $connection->query($sql) or die(mysqli_error($connection));  

        if ($result === false)
            die("Could not query database");
    }
    
    function addFile($connection, $file,$username){
        //$file=$file = $_FILES['file'];
        $file_name = $file['name'];
        $file_type = $file ['type'];
        $file_size = $file ['size'];
        $file_path = $file ['tmp_name'];
        
        $sql="INSERT into files (uuid(),$file_name,$file_size,DATE_ADD(now(),INTERVAL 1 WEEK), CURDATE(),$username,5,$file)";
    }
}


?>