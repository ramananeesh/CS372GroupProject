<?php
    require 'html-builder.php';
    
    session_start();
    
    if(isset( $_SESSION['notF'])){
        if($_SESSION['notF']){
            $fail = true;
            $_SESSION['notF'] = false;
        }
    }
    
?>

<html>
    <head>
        <?php insertHeader("DocDash");?>
        
        <!--Custom CSS -->
        <link href="./css/index.css" rel="stylesheet" type="text/css">
        
        <!-- Bootstrap and font awesome-->
        <link href="./css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="./css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="./css/slick-team-slider.css"  rel="stylesheet" type="text/css" />
        <link href="./css/style.css" rel="stylesheet" type="text/css">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
        
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/download.js"></script>
        
    </head>
    
    <body>
        <?php insertNav(); ?>
        <div class="jumbotron">
            <h1 class="small" style="text-align:center; color:black"><span class="bold">Doc->Dash </span>Downloads</h1>
        </div>
        <form id="form" onsubmit="download(); return false;">
        <div id="downloadDiv">
            <?php if($fail){echo '<div style="color:red;text-align:center;">File Download Failed: File is no longer in the system.</div> ';} ?>
            <div class="card" style="margin-left:15%; margin-right:15%; border-radius:20px "><br>
                <div class="container">
                    
                    <span class="label label-info">Please enter the UUID given while uploading the file</span><br>
                <div class="input-group">
                    
                    <span class="input-group-addon" id="basic-addon3">UUID : </span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3"/>
                    </div><br>
                    <input class="btn btn-primary" type="submit" id="submit" value="Download">
                </div><br>
            </div>
        </div>
        </form>
    </body>
</html>