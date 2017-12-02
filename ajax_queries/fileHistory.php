<?php
    /**
     * Fetches files in JSON format
     * using PHP's JSON extension.
     * 
     * You must pass 'user' in the request field
     * 
     * You must pass 'seeAll' = true to view all history (hidden ignored)
     * 
     */
     
    require_once('../database.php');
    
    $fileList = array();

    // Define a file
    class TransActMeta
    {
        public $id;
        public $was_upload;
        public $ipv6;
        public $file_id;
        public $fname;
        public $fsize;
        public $fuploadDate;
    }

    // set MIME type
    header("Content-type: application/json");
    
    // Create connection
    $conn = dbConnect();
    
    // Fetch the user's files
    $sql="select id, upload, ipv6, file_id, fname, fsize, fuploadDate from transactions where user_id=\"" . $conn->real_escape_string($_REQUEST['user']) . "\"";
    
    // Check if asked for explict history
    if($_REQUEST['seeAll'] == NULL || $_REQUEST['seeAll'] == false){
        $sql = $sql . " AND hidden = 0 AND upload = 1 ORDER BY time_stamp DESC";
    }
    
    $result=$conn->query($sql) or die(mysqli_error());
    
    while ($f = $result->fetch_assoc())
    {
        $file = new TransActMeta();
        
        $file->id = $f['id'];
        $file->was_upload = $f['upload'];
        $file->ipv6 = $f['ipv6'];
        $file->file_id = $f['file_id'];
        $file->fname = $f['fname'];
        $file->fsize = $f['fsize'];
        $file->fuploadDate = $f['fuploadDate'];
        
        array_push($fileList, $file);
        
    }

    // Return json
    print json_encode($fileList);
    mysqli_close($conn);
    exit;
?>