<?php 
    require 'html-builder.php';
    require 'database.php';
    
    session_start();
    $connection=dbConnect();
    $alert = false;
    
    // Check if request is comming from a bad IP
    checkIP($connection);
    
    
    if($_POST["submit"]){
        $file = $_FILES['input-b3'];
        
        if($file['tmp_name'] != NULL && trim($file['tmp_name']) != "" && trim($file['name']) != ""){
            $u=addFile($connection,$file,"NULL");
            $alert = true;
        }
    }
    
    
?>

<!DOCTYPE html>
<html>

    <head>
        
         <!-- PHP Header call [Title, Charset, and Icon Link] -->
        <?php insertHeader("Quick Send"); ?>
    
        <!-- Bootstrap and font awesome-->
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        
        
        
    
        <!-- File Input Scripts-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/piexif.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/sortable.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/purify.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/themes/fa/theme.js"></script>
        
        <!--<script src="./js/sweetalert.js"></script>-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        
    
    </head>
    
    <body>
    
        <!-- BEGIN NAVBAR -->
    
       <?php insertNav(); ?>
    
        <!-- END NAVBAR -->
    
        <!-- BEGIN MAIN CONTENT-->
        <div class="uploadDiv">
            <fieldset>
    
                <div class="page-title text-center">
                    <h1>Upload a File</h1>
                    <hr class="pg-titl-bdr-btm" style="background-color:blue"></hr>
                </div>
                
                <!-- SWEET ALERT CALLER -->
                <?php
                    if($alert)
                        echo "<script type=\"text/javascript\">sweetAlert(\"File Uploaded!\", \" UUID for sharing : $u \", \"success\")</script>";
                ?>
                
                <form action="" method="POST" enctype="multipart/form-data">
    
                    <div class="card" style="margin-left:15%; margin-right:15%; border-radius:20px ">
    
                        <div class="container" id="uploadDiv" style="margin-top:3%">
                            <!--<input id="input-b2" name="input-b2" type="file" size="40"  data-show-preview="false">
                           -->
                           <input id="input-b3" name="input-b3" type="file" class="file" multiple 
                            data-show-upload="false" data-show-caption="true" data-show-preview="false" data-msg-placeholder="Select {files} for upload...">
                            <br><input type="submit" name="submit" class="btn btn-primary" value="upload">
                        </div><br>
                        <h3 id="noteForFile" style="font-size:0.8em">Note that your file will be deleted after download or after 24 hours. If you wish to have more downloads or longer file time retention you can register as a user.</h3>
                    </div>
                </form>
    
            </fieldset>
        </div>
    
        <!-- END MAIN CONTENT-->
    </body>

</html>
