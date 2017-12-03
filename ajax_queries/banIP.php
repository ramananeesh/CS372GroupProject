<?php
    /**
     * Fetches files in JSON format
     * using PHP's JSON extension.
     * 
     * You must pass 'ip[]' as uuid in the request field
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
    
    if ($ban){
        
        // Build query
        foreach ($_REQUEST['ip'] as $value){
        
            $sql="INSERT INTO ip_ban VALUES (null,'".$conn->real_escape_string($value)."', '".$conn->real_escape_string($_REQUEST['date'])."');";
            
        }
        
    }else{
        // Build query
        foreach ($_REQUEST['ip'] as $value){
            
            if($firstItem){
                $firstItem = false;
                $sql="Delete FROM ip_ban where id=\"" . $conn->real_escape_string($value) . "\"";
            }
            else{
                $sql = $sql . " OR id=\"" . $conn->real_escape_string($value) . "\"";
            }
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