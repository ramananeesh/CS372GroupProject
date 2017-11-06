<?php
    require 'html-builder.php';
?>

<!DOCTYPE html>
<html>
    
    <head>
        
        <!-- PHP Header call [Title, Charset, and Icon Link] -->
        <?php insertHeader("About"); ?>
        
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       
        <!-- Custom CSS -->
        <link href="dashboard.css" rel="stylesheet" type="text/css">
        
        <!-- Bootstrap and font awesome-->
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        
    </head>
    
    <body>
        
        <!-- BEGIN NAVBAR -->
        
        <?php insertNav(); ?>
        
        <!-- END NAVBAR -->
        
        
        <!-- BEGIN MAIN CONTENT -->
        
        <div class="container" id="aboutText">
            
            <!-- About us -->
            <div class="page-title text-center">
                <h1>About Us</h1>
                <hr class="pg-titl-bdr-btm" style="background-color:blue"></hr>
            </div>
            <section>
                <p>Doc-Dash or (Doc Dash Dash) is a website designed by developers who were tired of wasting time sharing file. Doc dash is designed to be simple, fast, easy to use, and professional. We, the developers of a free web, want to liberate you
                    from the hassle of signing up and down every website you visit. Share a file with anybody, anytime, and anywhere without signing up or signing in or paying a dime so you can focus on more important things like food.
                </p>
                <p>
                    But, just like everybody else who says one thing but does another, you can create an account with us and experience the benefits of a website that knows your email and personal information. Creating an account is free, however, we do like money, so we
                    offer extra benefits to users who pay.
                </p>
            </section>
            
            <!-- Copyright -->
            <div class="page-title text-center">
                <h1>Copyright (or lack thereof)</h1>
                <hr class="pg-titl-bdr-btm" style="background-color:blue"></hr>
            </div>
            <section>
                <p>
                    You cannot share copyrighted material, unless you have the copyright! Sound obivious right? That means if you didn't pay a ridicolus amount of money (to buy the copyright), or put blood, sweat, and tears into a piece of work, you can't share it legally.
                    If you do share copyrighted material illegally using our website, first of all, shame on you. However, we won't hunt you down (we have more important things to do), but when a lawyer calls us up on the subject of copyright infringement,
                    we will gladly throw you under the bus with all of the information we collected on you.
                </p>
            </section>
            
        </div>
        
        <!-- END MAIN CONTENT-->
        
    </body>
    
</html>