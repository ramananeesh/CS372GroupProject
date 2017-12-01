<?php
    /**
     * Fetches messages in JSON format
     * using PHP's JSON extension.
     * 
     * You must pass 'message[]' as uuid in the request field
     * 
     * 
     */
     
    require_once('../database.php');
    
    $firstItem = true;
    $success = true;
    
    
    // Create connection
    $conn = dbConnect();
    
    // Build query
    foreach ($_REQUEST['message'] as $value){
        
        if($firstItem){
            $firstItem = false;
            $sql="Update contact set active = 0 where id=\"" . $conn->real_escape_string($value) . "\"";
        }
        else{
            $sql = $sql . " OR id=\"" . $conn->real_escape_string($value) . "\"";
        }
    }
    
    $result=$conn->query($sql) or die(mysqli_error($conn));
    
     // Return json
    if($result){
        print json_encode($success);
    }
    else{
        $success = false;
        print json_encode($success);
    }
    mysqli_close($conn);
    exit;
?>