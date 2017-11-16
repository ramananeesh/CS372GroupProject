<?php 
    require 'html-builder.php';
    
    define("USER","administrator");
	define("PASS","cs372DBLogin");
	define("DB","docdashDB");
	
	//connect to DB
	$connection=new mysqli('rds-mysql-docdash.cza6uneofziy.us-west-2.rds.amazonaws.com:3306',USER,PASS,DB);
	
	if($connection->connect_error){
		die('Connect Error (' .$connection->connect_errno . ') '
			. $connection->connect_error);
	}
	
	//if username and password were submitted, check them
	if(isset($_POST["name"])&&isset($_POST["email"])&&isset($_POST["comments"])){
		//prepare sql
		$sql=sprintf("INSERT INTO contact VALUES ('%s', '%s', ' ', '%s');;",
						$connection->real_escape_string($_POST["name"]),
						$connection->real_escape_string($_POST["email"]),
						$connection->real_escape_string($_POST["comments"]));
		
		//execute query
		$result=$connection->query($sql) or die(mysqli_error($connection));
		
		// TODO: Make this not suck
		echo "<br><br> <div style='color:green'>Your message has been submitted! We will contact you within 2-3 business days.</div>";
	}
?>

<!DOCTYPE html>
<html>
    
    <head>
    
         <!-- PHP Header call [Title, Charset, and Icon Link] -->
        <?php insertHeader("Contact"); ?>
        
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
                        <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
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
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <!-- END MAIN CONTENT-->
        
    </body>

</html>
