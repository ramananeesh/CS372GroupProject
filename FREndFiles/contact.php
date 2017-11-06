<?php 
    require 'html-builder.php';
?>

<!DOCTYPE html>
<html>
    
    <head>
    
         <!-- PHP Header call [Title, Charset, and Icon Link] -->
        <?php insertHeader("Contact"); ?>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Custom CSS -->
        <link href="dashboard.css" rel="stylesheet" type="text/css">
        
        <!-- Bootstrap and font awesome-->
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        
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
            
        <?php insertNav(); ?>
            
        <!-- END NAVBAR -->
        
        
        <!-- BEGIN MAIN CONTENT-->
        
        <div class="container">
            <br>
            <div class="container-fluid bg-grey" style="margin-top:6%">
                
                <div class="page-title text-center">
                    <h1>Get in touch with us!</h1>
                    <hr class="pg-titl-bdr-btm" style="background-color:blue"></hr>
                </div>
                
                <div class="row" style="margin-top:3%">
                    
                    <div class="col-sm-4">
                        <p>Contact us and we'll get back to you within 24 hours.</p>
                        <p><span class="glyphicon glyphicon-map-marker"></span> Fort Wayne, US</p>
                        <p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p>
                        <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
                    </div>
                    
                    <div class="col-sm-7">
                        
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                            </div>
                            <div class="col-sm-6 form-group">
                                <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                            </div>
                        </div>
                        
                        <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
                        
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <button class="btn btn-default pull-right" type="submit" id="sendContact">Send</button>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- END MAIN CONTENT-->
        
    </body>

</html>
