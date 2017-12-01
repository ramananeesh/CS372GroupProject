<?php
    /**
     * Must pass file_id
     * 
     * You must pass 'file' in the request field
     * 
     */
     
    require_once('../database.php');

    // Create connection
    $conn=dbConnect();
    
    // Fetch the user's files
    $sql="select fname, size, f_data from files where id=\"" . $conn->real_escape_string($_REQUEST['file']) . "\"";
    $result=$conn->query($sql) or die(mysqli_error());
    
    list($file, $size, $content) = mysqli_fetch_array($result);
    
    // Insert transaction
    
    
    header("Content-length: $size");
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$file");
    ob_clean();
    flush();
    echo $content;
    mysqli_close($conn);
    exit;
?>








