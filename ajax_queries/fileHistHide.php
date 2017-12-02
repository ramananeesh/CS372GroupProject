<?php
    /**
     *
     * 
     * You must pass 'hide[]=id' in the request field for
     *  each historical entry
     * 
     */
     
    require_once('../database.php');
    
    $firstItem = true;
    
    // Create connection
    $conn=dbConnect();
    
    // Build query
    foreach ($_REQUEST['hide'] as $value){
        
        if($firstItem){
            $firstItem = false;
            $sql="Update transactions set hidden = 1 where id=\"" . $conn->real_escape_string($value) . "\"";
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