<?php
  
  require_once 'html-builder.php';
  require_once('db_connect.php');
  session_start();
  
   $connection = connect_to_db();
   $adminUser=$_SESSION['userName'];
   $adminid=$_SESSION['userUuid'];
   $sql="select imgSrc from developers where userid=\"$adminid\" ";
   
   $result = $connection->query($sql) or die(mysqli_error($connection));
   if($result){
     $row=mysqli_fetch_assoc($result);
     $imgSrc=$row['imgSrc'];
   }
   
   // Send empty usernames back to Login
  if($_SESSION['userName'] === NULL || trim($_SESSION['userName']) === ""){
    header('Location: login.php');
  }
  
    // Verify an admin is sigining in
  	$sql="select userid from developers";
	  $pass = false;
	  
		if($result=$connection->query($sql)){
			while($row=mysqli_fetch_assoc($result)){
				if($row['userid'] == $adminid){
  				$pass = true;
  				break;
				}
			}
		}
		
		if($pass == false){
		  header("Location: ./dashboard.php");
		  exit;
		}
    
?>
<!DOCTYPE html>
<html>
  <head>

    <!-- PHP Header call [Title, Charset, and Icon Link] -->
    <?php insertHeader("Admin"); ?>
        
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="./admin/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="./admin/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="./admin/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="./admin/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="./admin/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="./admin/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
    <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600|Raleway:600,300|Josefin+Slab:400,700,600italic,600,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="./css/slick-team-slider.css" />
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    
    <style>
      body, th,td {
        color: white;
      }
    </style>
    <script src="./js/jquery-1.11.0.min.js"></script>
  <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
  </head>
  <body onload="onBodyLoad();">
        <!-- BEGIN NAVBAR -->
            
        <?php insertNav(); ?>
            
        <!-- END NAVBAR -->
    
    <div class="d-flex align-items-stretch">
      <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src=<?php echo '"' . "$imgSrc" . '"'; ?> alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5"><?php echo $adminUser ?></h1>
            <p>Developer</p>
          </div>
        </div><span class="heading">Main</span>
        <ul class="list-unstyled">
          <li class="active" id="homeNav"><a onclick="showHomeSection();"><i class="icon-home"></i>Home</a></li>
          <li id="userNav"> <a onclick="showUserSection()"> <i class="fa fa-users"></i>Users</a></li>
          <li id="msgNav"> <a onclick="showMessageSection()"> <i class="fa fa-commenting"></i>Messages</a></li>
          <li id="fileNav"> <a onclick="showFileSection()"> <i class="fa fa-files-o"></i>Files </a></li>
          <li id="ipNav"> <a onclick="showIpSection()"> <i class="fa fa-location-arrow"></i>IPs </a></li>
          <li id="settingNav"> <a onclick="showSettingSection()"> <i class="fa fa-cogs"></i>Settings </a></li>
          <li id="dashboardNav"> <a href="./dashboard.php"> <i class="fa fa-tachometer"></i>Dashboard </a></li>
          <li> <a href="sessionEnd.php"> <i class="fa fa-sign-out"></i>Login Page</a></li>
        </ul>
      </nav>
      <div class="page-content">
        
        <!-- Begin Home Section-->
        <div id="home-section">
        </div>
        <!-- End Home Section -->
        
        <!-- Users -->
        <div id='user-section' hidden>
        </div>
        
        <!-- Messages -->
        <div id="message-section" hidden>
        </div>
          
        <!-- Files -->
        <div id="file-section" hidden>
        </div>
          
        <!-- IP -->
        <div id="ip-section" hidden>
        </div>
          
        <div id="setting-section" hidden>
          <div class='page-header'>
              <div class='container-fluid'>
                  <h2 class='h5 no-margin-bottom'>Settings</h2>
              </div>
          </div>
          
          <table class='table table-striped'>
            <thead>
              <tr>
                <th>Name</th>
                <th>Value</th>
                <th>Last Modified</th>
                <th>Update</th>
              </tr>
            </thead>
            <tbody>
                <?php
                  $sql = "SELECT * FROM global_settings";
    
                  $connection = connect_to_db();
                  
                  // execute query
                  $result = $connection->query($sql) or die(mysqli_error());   
                
                  // check whether we found a row
                  while ($setting= $result->fetch_assoc())
                  {
                      echo "<tr>";
                      echo "<td>".$connection->real_escape_string($setting["g_name"])."</td>";
                      echo "<td><input type='text' id='setting-id-".$connection->real_escape_string($setting["id"])."' name='setting-id[]' value='".$connection->real_escape_string($setting["g_value"])."'/></td>";
                      echo "<td>".$connection->real_escape_string($setting["modified"])."</td>";
                      echo "<td><input type='submit' name='submit' class='btn btn-primary' value='update' onclick='updateSetting(".$connection->real_escape_string($setting["id"]).")'>";
                      echo "</tr>";
                  }
                ?>
            </tbody>
          </table>
        </div>

        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <p class="no-margin-bottom">2017 &copy; Doc->Dash. Design by <a href="./index.php#about">Dev->Team</a>.</p>
            </div>
          </div>
        </footer>
        
      </div>
    </div>
    <!-- Javascript files-->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"> </script>
    <script src="./admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./admin/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="./admin/vendor/chart.js/Chart.min.js"></script>
    <script src="./admin/js/charts-home.js"></script>
    <script src="./admin/js/front.js"></script>
    
    <link href="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/sweetalert2/4.2.4/sweetalert2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="./js/admin.js"></script>
  </body>
</html>