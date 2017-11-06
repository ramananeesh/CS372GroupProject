<?php 
    require 'html-builder.php';
?>
<!DOCTYPE html>

<html>

    <head>
         <!-- PHP Header call [Title, Charset, and Icon Link] -->
        <?php insertHeader("DocDash"); ?>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <!-- Custom CSS -->
        <link href="dashboard.css" rel="stylesheet" type="text/css">
        <link href="./css/index.css" rel="stylesheet" type="text/css">
        
        <!-- Bootstrap and font awesome-->
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="./css/slick-team-slider.css"  rel="stylesheet" type="text/css" />
        <link href="./css/style.css" rel="stylesheet" type="text/css">
    
    </head>

    <body>
        
        <!-- BEGIN NAVBAR -->
        
        <?php insertNav(); ?>
        
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
            
            <!-- END TEAM -->


            <!-- BEGIN CONTACT -->
            
            <div id="contact" class="section-padding">
                <div class="container">
                    <div class="page-title text-center">
                        <h1>Quick Contact</h1>
                        <hr class="pg-titl-bdr-btm" style="background-color:blue"/>
                    </div>
                    <div id="sendmessage">Your message has been sent. Thank you!</div>
                    <div id="errormessage"></div>
                </div>
                <div class="form-sec">
                    <form action="" method="post" role="form" class="contactForm">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <input type="text" name="name" class="form-control text-field-box" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                                    <div class="validation"></div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="email" class="form-control text-field-box" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                                    <div class="validation"></div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="text" class="form-control text-field-box" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                                    <div class="validation"></div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <textarea class="form-control text-field-box" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                                    <div class="validation"></div>

                                    <button class="button-medium" id="contact-submit" type="submit" name="contact" style="background-color:blue; border-color:blue">Submit Now</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
         <!-- END CONTACT -->
        
    </body>

</html>
