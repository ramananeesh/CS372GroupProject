<?php
    /**
     * Fetches files in JSON format
     * using PHP's JSON extension.
     * 
     * You must pass 'user' in the request field
     * 
     */
     
    require_once('../database.php');
    
    $fileList = array();

    // Define a file
    class FileMeta
    {
        public $id;
        public $name;
        public $size;
        public $expireDate;
        public $uploadDate;
        public $dCount;
    }

    // set MIME type
    header("Content-type: application/json");
    
    // Create connection
    $conn=dbConnect();
    
    // Fetch the user's files
    $sql="select fname,size,expire_date, upload_date, id, download_count from files where user_id=\"" . $conn->real_escape_string($_REQUEST['user']) . "\"";
    $result=$conn->query($sql) or die(mysqli_error());
    
    while ($f = $result->fetch_assoc())
    {
        $file = new FileMeta();
        
        $file->id = htmlspecialchars($f['id']);
        $file->name = htmlspecialchars($f['fname']);
        $file->size = htmlspecialchars($f['size']);
        $file->expireDate = htmlspecialchars($f['expire_date']);
        $file->uploadDate = htmlspecialchars($f['upload_date']);
        $file->dCount = htmlspecialchars($f['download_count']);
        
        array_push($fileList, $file);
        
    }

    // Return json
    print json_encode($fileList);
    mysqli_close($conn);
    exit;
?>