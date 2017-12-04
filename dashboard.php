<?php
  require_once 'html-builder.php';
  require_once 'database.php';
  $check = false;
  session_start();
    
  // Open Database connection
  $connection=dbConnect();
  
  // Start the session
  session_start();
  
  // Send empty usernames back to Login
  if($_SESSION['userName'] === NULL || trim($_SESSION['userName']) === ""){
    header('Location: login.php');
  }
  
  $username=$_SESSION['userName'];
  $userId=$_SESSION['userUuid'];
  $password=$_SESSION['password'];
  $typeOfLogin=$_SESSION['typeOfLogin'];
  $emailID=$_SESSION['emailID'];
  $name = $_SESSION['name'];
  
  // Pass the uuid of the user to the front end
  if($check == false)
    echo '<script>  sessionStorage.setItem("userID", "' . htmlspecialchars($userId) . '"); </script>';
  
   if($_POST["submit"]){
      $file = $_FILES['input-b3'];
      
      if($file['tmp_name'] != NULL && trim($file['tmp_name']) != "" && trim($file['name']) != ""){
        addFile($connection,$file,$userId);
      }
    }

    if(isset($_POST['action']) && $_POST['action'] == "deleteFiles"){
      echo '<script> alert("The User would like you to delete the files!");</script>';
      $deleted = $_POST['checkbox'];
        foreach ($deleted as $fileID) 
        {
	          $query="delete from files where id='$fileID'";
	          $result= $connection->query($query) or die(mysqli_error($connection));
        }
       
        echo '<script> alert("Done!");</script>';
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
  
  
  <!-- This is for the file upload stuff -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />
  <!-- if using RTL (Right-To-Left) orientation, load the RTL CSS file after fileinput.css by uncommenting below -->
  <!-- link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/css/fileinput-rtl.min.css" media="all" rel="stylesheet" type="text/css" /-->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <!-- piexif.min.js is only needed for restoring exif data in resized images and when you 
    wish to resize images before upload. This must be loaded before fileinput.min.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/piexif.min.js" type="text/javascript"></script>
  <!-- sortable.min.js is only needed if you wish to sort / rearrange files in initial preview. 
    This must be loaded before fileinput.min.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/sortable.min.js" type="text/javascript"></script>
  <!-- purify.min.js is only needed if you wish to purify HTML content in your preview for 
    HTML files. This must be loaded before fileinput.min.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/plugins/purify.min.js" type="text/javascript"></script>
  <!-- popper.min.js below is needed if you use bootstrap 4.x. You can also use the bootstrap js 
   3.3.x versions without popper.min.js. -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
  <!-- bootstrap.min.js below is needed if you wish to zoom and preview file content in a detail modal
    dialog. bootstrap 4.x is supported. You can also use the bootstrap js 3.3.x versions. -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" type="text/javascript"></script>
  <!-- the main fileinput plugin file -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script>
  <!-- optionally if you need a theme like font awesome theme you can include it as mentioned below -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/themes/fa/theme.js"></script>
  <!-- optionally if you need translation for your language then include  locale file as mentioned below -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

  <!--Other normal HTML Stuff -->
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
  
  <?php
    insertHeader("Doc Track");
  ?>
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <meta name="google-signin-client_id" content="783497289681-md44u43oh563o2jrf0gjsfbtgr6oh2qg.apps.googleusercontent.com">
  
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/jquery.validate.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.payment/1.2.3/jquery.payment.min.js"></script>

  <!-- If you're using Stripe for payments -->
  

</head>

<body onload="attachCallback();initialize();">
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="index.php" id="dashboardLogo"><img src="./images/logo.ico" width="25px" height="25px"> Doc -> Dash</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">

      </ul>
      <form class="form-inline mt-2 mt-md-0">
        <a class="navbar-brand" href="#" id="usernameDisplay"><label id="usern" name="username">Hello, <?php echo htmlspecialchars($name) ?></label></a>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick="signO();">Sign Out</button>
      </form>
    </div>
  </nav>
  <br>
  <div class="container-fluid">
    <div class="row">
      <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar" id="sideNav">
        <ul class="nav nav-pills flex-column">
          <li class="nav-item">
            <a class="nav-link" href="index.php" id="home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" onclick="filesClick()" href="#Files" id="fileListLink">Files <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="settingsClick()" href="#Settings" id="settingListLink">Settings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick="proClick()" id="goProLink" href="#GoPro">Go Pro!</a>
          </li>
        </ul>
      </nav>

      <section class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main" id="Dashboard">
        <h1>Dashboard</h1>

        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" onclick='activeClick()' id="actLink" href="#Active">Active</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" onclick='historyClick()' id="hisLink" href="#History">History</a>
          </li>
        </ul>

        <section class="row text-center placeholders" id="dashboardElements">
          <div class="col-6 col-sm-3 placeholder" id="divUpload">
            <a href="#uploadFile" onclick="uploadClick();">
                <img src="./images/uploadicon.png" width="100" height="100" class="img-fluid rounded-circle" alt="Upload Button">
              </a>
            <h4>Upload</h4>
            <span class="text-muted"><a href="#uploadFile"></a>Upload File</span>
          </div>
          <div class="col-6 col-sm-3 placeholder" id="divDownload">
            <a href="#Download">
                  <img src="./images/downloadicon.png" width="100" height="100" class="img-fluid rounded-circle" onclick="downloadRequest();" alt="Download Button">
              </a>
            <h4>Download</h4>
            <span class="text-muted">Download Selected File(s)</span>
          </div>
          <div class="col-6 col-sm-3 placeholder" id="divShare">
            <a href="#Share">
              <img src="./images/shareicon.png" width="100" height="100" class="img-fluid rounded-circle" onclick="shareFile();" alt="Share Button">
            </a>
            <h4>Share</h4>
            <span class="text-muted">Share or Modify File Access</span>
          </div>
          
         
          <div class="col-6 col-sm-3 placeholder" id="divDelete">
            <form method="POST" action="">
              <a href="#Delete">
                <!--button id="delete" type="submit"-->
                <!-- img src="./images/delete icon.jpg" name="delete" width="100" height="100" class="img-fluid rounded-circle" alt="Delete Button" -->
                <input type="hidden" name="action" value="deleteFiles">
                <img src="./images/delete icon.jpg" width="100" height="100" onclick="deleteSomething();" class="img-fluid rounded-circle" alt="Delete Button" />
                <!--/button-->
              </a>
              <h4>Delete</h4>
              <span class="text-muted">Delete Selected File(s)</span>
            <!--</form>-->
          </div>
        </section>

        <!--Active File Table -->

        <div class="table-responsive" id="fileList">
          <h2 id="fileListTitle">Active File List</h2>
          <!--<form method="POST">-->
          <table class="table table-striped" id="UserFileTable">
            <thead>
              <tr>
                <th><input type="checkbox" onclick="checkAll('checkbox[]','fileAll')" id="fileAll" />&nbsp&nbspSelect All</th>
                <th>Name</th>
                <th>Size (Kb)</th>
                <th>Expiration Date</th>
              </tr>
            </thead>
            <tbody id="userFiles">
              
            </tbody>
            </table>
            </form>
        </div>

        <!--File History Table -->
        <h2 id="historyTitle" style="display:none;">File History List</h2>
        <div class="table-responsive" id="history" style="display:none;">
          <table class="table table-striped" id="historyTable">
            <thead>
              <tr>
                <th><input type="checkbox" onclick="checkAll('entrySelected[]','histAll')" id="histAll" />&nbsp&nbspSelect All</th>
                <th>Name</th>
                <th>Size (Kb)</th>
                <th>Upload Date</th>
              </tr>
            </thead>
            <tbody id="historyFiles">
            </tbody>
          </table>
        </div>
      </section>

      <section class="col-sm-9 ml-sm-auto col-md-10 pt-3" id="settings" style="display:none;">
        <h1>Settings</h1>
        <!--Setting Management-->
        <div class="card">
          <div class="card-header">
            User Information
          </div>
          <div class="card-body" style="padding:1.5em;">
            <p class="card-text">Email: <?php echo htmlspecialchars($emailID);?><label id="emailID"></label></p>
            <p class="card-text"><label id="passwordField" type></label></p>
            <!--<a href="#" class="btn btn-primary" id="changePassword">Change Password</a>-->
            <button class="btn btn-primary" id="changePassword">Change Password</button>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header">
            File Defaults
          </div>
          <div class="card-body">
            <p class="card-text">
              <div class="form-group">
                <label for="sel1">Delete Preference: </label>
                <select class="form-control" id="sel1">
                  <option>Whichever First</option>
                  <option>Time Expiration</option>
                  <option>Download Expiration</option>
                </select>
              </div>
              <div class="form-group">
                <label for="sel1">File Retention: </label>
                <select class="form-control" id="sel1">
                  <option>1 Day</option>
                  <option>1 Week</option>
                  <option>1 Month</option>
                </select>
              </div>
              <div class="form-group">
                <label for="sel1">Download Limit: </label>
                <select class="form-control" id="sel1">
                  <option>1 Download</option>
                  <option>5 Downloads</option>
                  <option>10 Downloads</option>
                </select>
              </div>

            </p>
            <a href="#" class="btn btn-primary">Save Changes</a>
          </div>
        </div>
        <br>
        <div class="card">
          <div class="card-header">
            Pro Status
          </div>
          <div class="card-body">
            <p class="card-text" 
            <?php 
              if($_SESSION['pro'] == 1){
                echo 'style="color:green;">Active</p>';
                echo '<a href="#" class="btn btn-primary">Cancel Subscription</a>';
              }
              else{
                echo 'style="color:red;">Disabled</p>';
                echo '<a href="#" class="btn btn-primary">Upgrade</a>';
              }
            ?>
          </div>
        </div>
      </section>
      <section class="col-sm-9 ml-sm-auto col-md-10 pt-3" id="uploadFile" style="display:none">
        <div>
          <form method="POST" action="" enctype="multipart/form-data">
            <h2>Upload a File</h2><br>
          <div class="container" id="uploadDiv">
             <input id="input-b3" name="input-b3" type="file" class="file" multiple 
                            data-show-upload="false" data-show-caption="true" data-show-preview="false" data-msg-placeholder="Select {files} for upload...">
                            <br><input type="submit" name="submit" class="btn btn-primary" value="upload">
          </div><br>
          </form>
          
        </div>
      </section>
      <!--payment stuff-->
      <section class="col-sm-9 ml-sm-auto col-md-10 pt-3" id="goPro" style="display:none !important">
        <div class="container" style="margin-left:5%">
          <div class="row">
            <!-- You can make it whatever width you want. I'm making it full width
             on <= small devices and 4/12 page width on >= medium devices -->
            <div class="col-xs-12 col-md-4">


              <!-- CREDIT CARD FORM STARTS HERE -->
              <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table">
                  <div class="row display-tr">
                    <div class="page-title text-center">
                      <h3>Payment Details</h1>
                        <hr class="pg-titl-bdr-btm" style="background-color:blue"></hr>
                    </div>
                  </div>
                  <!--<h3 class="panel-title display-td">Payment Details</h3>-->
                  <div class="row display-tr">
                    <div class="page-title text-center">
                      <div class="display-td">
                        <img class="img-responsive pull-right" src="https://i76.imgup.net/accepted_c22e0.png">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel-body">
                  <form role="form" id="payment-form" method="POST" action="javascript:void(0);">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="cardNumber">CARD NUMBER</label>
                          <div class="input-group">
                            <input type="tel" class="form-control" name="cardNumber" placeholder="Valid Card Number" autocomplete="cc-number" required autofocus />
                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-7 col-md-7">
                        <div class="form-group">
                          <label for="cardExpiry"><span class="hidden-xs">EXPIRATION</span><span class="visible-xs-inline">EXP</span> DATE</label>
                          <input type="tel" class="form-control" name="cardExpiry" placeholder="MM / YY" autocomplete="cc-exp" required />
                        </div>
                      </div>
                      <div class="col-xs-5 col-md-5 pull-right">
                        <div class="form-group">
                          <label for="cardCVC">CV CODE</label>
                          <input type="tel" class="form-control" name="cardCVC" placeholder="CVC" autocomplete="cc-csc" required />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label for="couponCode">COUPON CODE</label>
                          <input type="text" class="form-control" name="couponCode" />
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-12">
                        <button class="subscribe btn btn-success btn-lg btn-block" type="button">Start Subscription</button>
                      </div>
                    </div>
                    <div class="row" style="display:none;">
                      <div class="col-xs-12">
                        <p class="payment-errors"></p>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <!-- CREDIT CARD FORM ENDS HERE -->


            </div>

            <div class="col-xs-12 col-md-8" style="font-size: 12pt; line-height: 2em;">
              <p>
                <div>
                <div class="page-title text-center" style="margin-left:2%">
                      <h3>Features</h1>
                        <hr class="pg-titl-bdr-btm" style="background-color:blue"></hr>
                    </div>
                <div style="margin-left:18%; border-radius:20px; margin-right:20%" class="card">
                <ul style="margin-left:2%">
                  <li>Upload/Share more files</li>
                  <li>Extend the storage space</li>
                  <li>Keep files for a longer time in the dashboard</li>
                </ul>
                
              </p>
              <p style="margin-left:2%; font-size:1.5em; font-weight:bold">Can cancel your membership anytime!</p>
                </div>
            </div>
            </div>
          </div>
        </div>

      </section>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <!--script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  <script type="text/javascript" src="./js/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  <script type="text/javascript" src="./js/admin.js"></script>
  <script type="text/javascript" src="./js/dashboard.js"></script>
</body>

</html>
