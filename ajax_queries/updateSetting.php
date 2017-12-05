<?php
    /**
     * Fetches files in JSON format
     * using PHP's JSON extension.
     * 
     * You must pass 'id' as uuid in the request field
     * 
     * You must pass 'value'
     * 
     */
     
    require_once('../database.php');
    
    $success = true;
    
    // Create connection
    $conn = dbConnect();
    
    $sql =  "UPDATE global_settings SET g_value = ".$_REQUEST['value']." WHERE id = ".$_REQUEST['id'];
    
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