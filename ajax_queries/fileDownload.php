<?php
    /**
     * Must pass file_id
     * 
     * You must pass 'file' as uuid in the request field
     * 
     */
     
    require_once('../database.php');
    
    // Restart the session to grab username
    session_start();

    // Create connection
    $conn=dbConnect();
    
    // Fetch the user's files
    $sql="select fname, size, upload_date, f_data from files where id=\"" . $conn->real_escape_string($_REQUEST['file']) . "\"";
    $result=$conn->query($sql) or die(mysqli_error());
    
    list($file, $size, $uDate, $content) = mysqli_fetch_array($result);
    
    // Insert transaction
    $sql="Insert into transactions(upload, ipv6, file_id, user_id, fname, fsize, fuploadDate)" . "
                    values (0, \"" . $_SERVER['REMOTE_ADDR'] . "\", \"" . $_REQUEST['file'] ."\", \"" . $_SESSION['userUuid'] . "\", \"$file\", \"$size\",\"$uDate\")";
    
    // Insert transaction       
    $result=$conn->query($sql) or die(mysqli_error($conn));
    
    header("Content-length: $size");
    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=$file");
    ob_clean();
    flush();
    echo $content;
    mysqli_close($conn);
    exit;
?>








