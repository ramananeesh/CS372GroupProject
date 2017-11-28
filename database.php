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

function addUser($connection, $details, $idOverride = NULL){
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
        if($idOverride == NULL){
            $sql = sprintf("INSERT INTO `users` VALUES (UUID(),'%s','%s', password('%s'),'%s',1,0,0,SYSDATE())",
                   $connection->real_escape_string($username),
                   $connection->real_escape_string($name),
                   $connection->real_escape_string($password),
                   $connection->real_escape_string($email));
        }
        else{
            $sql = sprintf("INSERT INTO `users` VALUES ('%s','%s','%s', password('%s'),'%s',1,0,0,SYSDATE())",
                   $connection->real_escape_string($idOverride),
                   $connection->real_escape_string($username),
                   $connection->real_escape_string($name),
                   $connection->real_escape_string($password),
                   $connection->real_escape_string($email));
        }
        
        // execute query
        $result = $connection->query($sql) or die(mysqli_error($connection));  

        if ($result === false)
            die("Could not query database");
    }
}

function addFile($connection,$file,$userid){

    $file_name = $file['name'];
    $file_type = $file ['type'];
    $file_size = $file ['size'];
    $file_path = $file ['tmp_name'];
    
    $data=mysqli_real_escape_string($connection,file_get_contents($file_path));
    $n="NULL";
    
    // Generate UUID
    $sql = "select uuid() as id from dual";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row = $result->fetch_assoc();
    $uuid = $row['id'];
    
    //if username is not null - for registered users
    if(!($userid===$n)){
        $sql="INSERT into files (id,fname,size,user_id,download_count,f_data) values (\"$uuid\",\"$file_name\",$file_size,\"$userid\",5,'".$data."')";
    }
    else{
        //for ur-users
         $sql="INSERT into files (id,fname,size,download_count,f_data) values (\"$uuid\",\"$file_name\",$file_size,5,'".$data."')";
    }
    
    //(id,fname,size,expire_date,upload_date,user_id,download_count,f_data) 

    $result=$connection->query($sql) or die(mysqli_error($connection));
    
    // Insert a transaction record
    // upload = 1, ipv6, file_id, user_id, hidden = 0
                 
    if(!($userid===$n)){
         $sql = "INSERT into transactions (upload, ipv6, file_id, user_id, hidden)" . 
                "values (1, \"$_SERVER[REMOTE_ADDR]\",\"$uuid\",\"$userid\",0 )";
    }
    else{
         $sql = "INSERT into transactions (upload, ipv6, file_id, hidden)" . 
                "values (1, \"$_SERVER[REMOTE_ADDR]\",\"$uuid\", 0 )";
    }
    
    $result=$connection->query($sql) or die(mysqli_error($connection));
    
}

function getFilesList(){
    
}

function checkIP($connection){
    
    // Check if user is using a banned IP
	$sql=sprintf("SELECT * from ip_ban where ipv6='%s'",
			$connection->real_escape_string($_SERVER['REMOTE_ADDR']));
			
	// Execute SQL
	$result=$connection->query($sql) or die(mysqli_error());
	if($result->num_rows==1){
		
		// Loop through results
		 while ($row1 = $result->fetch_assoc())
		 {
		 	if (time() >= strtotime($row1['time_out'])) {
				// Over time limit - Delete row
				$sql=sprintf("DELETE FROM ip_ban
									WHERE id=%s",$row1['id']);
				$connection->query($sql) or die(mysqli_error());
			}
			else{
				echo "<h1>Your IP has been flagged as banned. Check back later or contest the ban through the contact page.</h1>";
				echo "<h3><a href=\"./contact.php\">Contact Us</a></h3>";
				exit;
			}
		 }
	}
}

?>