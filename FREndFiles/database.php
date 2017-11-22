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
}
    function addFile($connection,$file,$username){
        //$file=$file = $_FILES['file'];
         //$file = $_FILES['input-b3'];
            //addFile($connection,$file,$username);
             $file_name = $file['name'];
         $file_type = $file ['type'];
         $file_size = $file ['size'];
         $file_path = $file ['tmp_name'];
        
        
         $data=mysqli_real_escape_string($connection,file_get_contents($file_path));
        $n="NULL";
        //if username is not null - for registered users
        if(!($username===$n)){
            $r=$connection->query("select id from users where username = \"$username\"") or die(mysqli_error($connection));
            $row=mysqli_fetch_assoc($r);
            $userid=$row['id'];
             $sql="INSERT into files (id,fname,size,user_id,download_count,f_data) values (uuid(),\"$file_name\",$file_size,\"$userid\",5,'".$data."')";
        }
        else{
            //for ur-users
             $sql="INSERT into files (id,fname,size,download_count,f_data) values (uuid(),\"$file_name\",$file_size,5,'".$data."')";
        }
        
        //(id,fname,size,expire_date,upload_date,user_id,download_count,f_data) 
       
        //echo $sql;
        $result=$connection->query($sql) or die(mysqli_error($connection));
        
    }

?>