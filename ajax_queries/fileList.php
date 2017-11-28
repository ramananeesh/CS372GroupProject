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
        public $userId;
        public $dCount;
    }

    // set MIME type
    header("Content-type: application/json");
    
    // Create connection
    $conn=dbConnect();
    
    // Fetch the user's files
    $sql="select fname,size,expire_date,id from files where user_id=\"" . $conn->real_escape_string($_REQUEST['user']) . "\"";
    $result=$conn->query($sql) or die(mysqli_error());
    
    while ($f = $result->fetch_assoc())
    {
        $file = new FileMeta();
        
        $file->id = $f['id'];
        $file->name = $f['fname'];
        $file->size = $f['size'];
        $file->expireDate = $f['expire_date'];
        $file->uploadDate = $f['upload_date'];
        $file->userId = $f['user_id'];
        $file->dCount = $f['download_count'];
        
        array_push($fileList, $file);
        
    }

    // Return json
    print json_encode($fileList);
    
?>