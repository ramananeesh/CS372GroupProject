<?php 
    require_once 'html-builder.php';
    
?>
<!DOCTYPE html>

<html>

    <head>
         <!-- PHP Header call [Title, Charset, and Icon Link] -->
        <?php insertHeader("DocDash"); ?>
        
        <!-- Custom CSS -->
        <link href="./css/index.css" rel="stylesheet" type="text/css">
        
        <!-- Bootstrap and font awesome-->
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="./css/slick-team-slider.css"  rel="stylesheet" type="text/css" />
        <link href="./css/style.css" rel="stylesheet" type="text/css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    </head>

    <body>
        
        <!-- BEGIN NAVBAR -->
        
        <?php 
        require 'contact_form.php';
        insertNav(); 
        ?>
        
        <!-- END NAVBAR -->
        
        
        <!-- BEGIN WELCOME -->
        
        <div id="banner" class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="jumbotron">
                        <h1 class="small">Welcome To <span class="bold">Doc->Dash</span></h1>
                        <p class="big">The Easiest Way to Share Files</p>
                        <a href="./about.php" class="btn btn-banner" style="border-style:solid; border-radius:20px;" id="learnMore">Learn More<i class="fa fa-info-circle"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- END WELCOME -->


        <!-- BEGIN TEAM -->
        
        <div id="about" class="section-padding">
            <div class="container">
                <div class="page-title text-center">
                    <h1>Meet Our Team</h1>
                    <hr class="pg-titl-bdr-btm" style="background-color:blue"/>
                </div>
                <div class="autoplay">
                    <?php insertTeam() ?>
                </div>
            </div>
        </div>
            
        <!-- END TEAM -->


        <!-- BEGIN CONTACT -->
        
        <?php
        
        insertContactForm(); ?>
        
        <!-- END CONTACT -->
        
    </body>

</html>
