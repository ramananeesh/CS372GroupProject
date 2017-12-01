<?php
    /**
     * Fetches files in JSON format
     * using PHP's JSON extension.
     * 
     * You must pass 'user[]' as uuid in the request field
     * 
     * You must pass 'ban' = false to revoke a ban
     * 
     */
     
    require_once('../database.php');
    
    // Default action is to ban user
    $ban = 1;
    $firstItem = true;
    $success = true;
    
    // Check if an admin is revoking a ban
    if($_REQUEST['ban'] === "false"){
        $ban = 0;
    }
    
    // Create connection
    $conn = dbConnect();
    
    // Build query
    foreach ($_REQUEST['user'] as $value){
        
        if($firstItem){
            $firstItem = false;
            $sql="Update users set banned = $ban where id=\"" . $conn->real_escape_string($value) . "\"";
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