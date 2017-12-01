<?php
    /**
     *
     * 
     * You must pass 'delete[]=uuid' in the request field for
     *  each deleted file
     * 
     */
     
    require_once('../database.php');
    
    $firstItem = true;

    // set MIME type
    header("Content-type: application/json");
    
    // Create connection
    $conn=dbConnect();
    
    // Build query
    foreach ($_REQUEST['delete'] as $value){
        
        if($firstItem){
            $firstItem = false;
            $sql="Delete from files where id=\"" . $conn->real_escape_string($value) . "\"";
        }
        else{
            $sql = $sql . " OR id=\"" . $conn->real_escape_string($value) . "\"";
        }
    }
   
    // Run Query
    $result=$conn->query($sql) or die(mysqli_error($conn));
    mysqli_close($conn);
    exit;
?>