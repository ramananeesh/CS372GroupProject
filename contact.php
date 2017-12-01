<?php 
    require_once 'html-builder.php';
    
 
?>

<!DOCTYPE html>
<html>
    
    <head>
    
         <!-- PHP Header call [Title, Charset, and Icon Link] -->
        <?php insertHeader("Contact"); ?>
        
        <!-- Bootstrap and font awesome-->
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        <style>
            #sendContact:hover{
                color:white;
                background-color:blue;
                font-size:1.5em;
                font-weight:bold;
            }
        </style>
        
    </head>

    <body>
        
        <!-- BEGIN NAVBAR -->
            
        <?php 
        require_once 'contact_form.php';
        insertNav(); ?>
            
        <!-- END NAVBAR -->
        
        
        <!-- BEGIN MAIN CONTENT-->
        
        <?php insertContactForm(); ?>
        
        <!-- END MAIN CONTENT-->
        
    </body>

</html>
