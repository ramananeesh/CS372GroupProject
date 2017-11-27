<?php
  
  require_once 'html-builder.php';
  require_once('db_connect.php');
  

   $connection = connect_to_db();
   
   if(isset($_POST['action']) && $_POST['action'] == "deleteMessage"){
     
      $messagesToDelete = $_POST['message-id'];
      
      if (isset($_POST['message-id'])) {
          
          foreach ($messagesToDelete as $message){
              
              $sql = sprintf("DELETE FROM contact WHERE id = '%s'",
              $connection->real_escape_string($message));
            
              // execute query
              $result = $connection->query($sql) or die(mysqli_error($connection));
              
              if ($result === false)
                  die("Could not query database");
              
          }
          
      } else {
          echo "You did not choose a message.";
      }
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
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
    
    <script>
      
      function showHomeSection(){
        hideEverything();
        var homeSection = document.getElementById('home-section');
        homeSection.hidden = false;
        homeSection.classList.add("active");
      }
      
      function showMessageSection(){
        hideEverything();
        var messageSection = document.getElementById('message-section');
        messageSection.hidden = false;
        messageSection.classList.add("active");
      }
      
      function showUserSection(){
        hideEverything();
        var userSection = document.getElementById('user-section');
        userSection.hidden = false;
        userSection.classList.add("active");
      }
      
      function showFileSection(){
        hideEverything();
        var fileSection = document.getElementById('file-section');
        fileSection.hidden = false;
        fileSection.classList.add("active");
      }
      
      function showIpSection(){
        hideEverything();
        var ipSection = document.getElementById('ip-section');
        ipSection.hidden = false;
        ipSection.classList.add("active");
      }
      
      function showSettingSection(){
        hideEverything();
        var settingSection = document.getElementById('setting-section');
        settingSection.hidden = false;
        settingSection.classList.add("active");
      }
      
      function hideEverything(){
        var homeSection = document.getElementById('home-section');
        var messageSection = document.getElementById('message-section');
        var userSection = document.getElementById('user-section');
        var fileSection = document.getElementById('file-section');
        var ipSection = document.getElementById('ip-section');
        var settingSection = document.getElementById('setting-section');
        
        homeSection.hidden = true;
        messageSection.hidden = true;
        userSection.hidden = true;
        fileSection.hidden = true;
        ipSection.hidden = true;
        settingSection.hidden = true;
        
        homeSection.classList.remove("active");
        messageSection.classList.remove("active");
        userSection.classList.remove("active");
        fileSection.classList.remove("active");
        ipSection.classList.remove("active");
        settingSection.classList.remove("active");
      }
      
    </script>
  </head>
  <body>
        <!-- BEGIN NAVBAR -->
            
        <?php insertNav(); ?>
            
        <!-- END NAVBAR -->
    
    <br/>
    <div class="d-flex align-items-stretch">
      <nav id="sidebar">
        <div class="sidebar-header d-flex align-items-center">
          <div class="avatar"><img src="./images/profilePic_MatthewHunt.jpg" alt="..." class="img-fluid rounded-circle"></div>
          <div class="title">
            <h1 class="h5">Matthew Hunt</h1>
            <p>Developer</p>
          </div>
        </div><span class="heading">Main</span>
        <ul class="list-unstyled">
          <li class="active"><a onclick="showHomeSection();"><i class="icon-home"></i>Home</a></li>
          <li> <a onclick="showUserSection()"> <i class="fa fa-bar-chart"></i>Users</a></li>
          <li> <a onclick="showMessageSection()"> <i class="fa fa-bar-chart"></i>Messages</a></li>
          <li> <a onclick="showFileSection()"> <i class="fa fa-bar-chart"></i>Files </a></li>
          <li> <a onclick="showIpSection()"> <i class="icon-padnote"></i>IPs </a></li>
          <li> <a onclick="showSettingSection()"> <i class="icon-padnote"></i>Settings </a></li>
          <li> <a href="login.html"> <i class="icon-logout"></i>Login Page</a></li>
        </ul>
      </nav>
      <div class="page-content">
        
      
        
        <!-- Begin Home Section-->
        <div id="home-section">
          
          <div class="page-header">
            <div class="container-fluid">
              <h2 class="h5 no-margin-bottom">Dashboard</h2>
            </div>
          </div>
            <section class="no-padding-top no-padding-bottom">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="icon-user-1"></i></div><strong>New Users</strong>
                        </div>
                        <div class="number dashtext-1">27</div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="icon-contract"></i></div><strong>New Files</strong>
                        </div>
                        <div class="number dashtext-2">375</div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-2"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>New Visitors</strong>
                        </div>
                        <div class="number dashtext-3">140</div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style="width: 55%" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-3"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All Projects</strong>
                        </div>
                        <div class="number dashtext-4">41</div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style="width: 35%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-4"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section class="no-padding-bottom">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="bar-chart block no-margin-bottom">
                      <canvas id="barChartExample1"></canvas>
                    </div>
                    <div class="bar-chart block">
                      <canvas id="barChartExample2"></canvas>
                    </div>
                  </div>
                  <div class="col-lg-8">
                    <div class="line-cahrt block">
                      <canvas id="lineCahrt"></canvas>
                    </div>
                  </div>
                </div>
              </div>
            </section>
        </div>
        <!-- End Home Section -->
        
        <br>
        <br>
        <br>
        <br>
         <!-- Begin Messages-->
        <div id="message-section" hidden>
         <div class="page-header">
            <div class="container-fluid">
              <h2 class="h5 no-margin-bottom">Messages</h2>
            </div>
          </div>
          <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
          <section class="row text-center placeholders">
              <div class="col-6 col-sm-3 placeholder" id="divDelete">
           
              <a href="#Delete">
                <!--button id="delete" type="submit"-->
                <!-- img src="./images/delete icon.jpg" name="delete" width="100" height="100" class="img-fluid rounded-circle" alt="Delete Button" -->
                <input type="hidden" name="action" value="deleteMessage">
                <input type="image" src="./images/delete icon.jpg" width="100" height="100" class="img-fluid rounded-circle" alt="Delete Button" />
                <!--/button-->
              </a>
              <h4>Delete</h4>
              <span class="text-muted">Delete Selected Message(s)</span>
            
          </div>
            </section>
          
            <div class="table-responsive" id="fileList">
              
              
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Select</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Time stamp</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      
                      // read
                    
                      $sql = sprintf("Select * FROM contact WHERE active = 1 ORDER BY time_stamp DESC;");
    
                      // execute query
                      $result = $connection->query($sql) or die(mysqli_error());   
    
                      // check whether we found a row
                      while ($contact= $result->fetch_assoc())
                      {
                          echo "<tr>";
                          echo "<td><input type='checkbox' id='message-id' name='message-id[]' value='".$contact["id"]."'/></td>";
                          echo "<td>".$contact["name"]."</td>";
                          echo "<td>".$contact["email"]."</td>";
                          echo "<td>".$contact["message"]."</td>";
                          echo "<td>".$contact["time_stamp"]."</td>";
                          echo "</tr>";
                      }
                    ?>
                </tbody>
              </table>
            </div>
            </form>
        </div>
        
        <!-- End Messages -->
       
       
        <!--users list-->
         <div id="user-section" hidden>
           
           <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Banned</a>
              </li>
            </ul>
  
            <section class="row text-center placeholders">
              <div class="col-6 col-sm-3 placeholder">
                <a href="#Download">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="100" height="100" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                </a>
                <h4>Ban</h4>
                <span class="text-muted">Ban Selected User(s)</span>
              </div>
              <div class="col-6 col-sm-3 placeholder">
                <a href="#Delete">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="100" height="100" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                </a>
                <h4>Reactivate</h4>
                <span class="text-muted">Reactivate Selected Users(s)</span>
              </div>
            </section>
            
            <h2>Active User List</h2>
            <div class="table-responsive" id="fileList">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Select</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Join Date</th>
                  </tr>
                </thead>
                <tbody>
                   <?php
                      
                      // read
                    
                      $sql = sprintf("Select * FROM users ORDER BY username");
    
                      // execute query
                      $result = $connection->query($sql) or die(mysqli_error());   
    
                      // check whether we found a row
                      while ($contact= $result->fetch_assoc())
                      {
                          echo "<tr>";
                          echo "<td><input type='checkbox' name='selected'/></td>";
                          echo "<td>".$contact["username"]."</td>";
                          echo "<td>".$contact["name"]."</td>";
                          echo "<td>".$contact["email"]."</td>";
                          echo "<td>".$contact["dateActive"]."</td>";
                          echo "</tr>";
                      }
                    ?>
                </tbody>
              </table>
            </div>
          </div>
          <!--End users section-->
          
          
          <!--File section -->
          <div id="file-section" hidden>
             <section class="row text-center placeholders">
              <div class="col-6 col-sm-3 placeholder">
                <a href="#Download">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="100" height="100" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                </a>
                <h4>Delete</h4>
                <span class="text-muted">Ban Selected File(s)</span>
              </div>
            </section>
            
            
            <h2>Files</h2>
            <div class="table-responsive" id="fileList">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Select</th>
                    <th>File Name</th>
                    <th>User</th>
                    <th>Created Date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>img.png</td>
                    <td>huntmj01</td>
                    <td>10/06/2017</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>file.txt</td>
                    <td>AhhhhYeah</td>
                    <td>10/05/2017</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>animate.gif</td>
                    <td>TopDawg</td>
                    <td>10/04/2017</td>
                </tbody>
              </table>
            </div>
          </div>
          <!--End file section -->
          
          <!-- IP section -->
          <div id="ip-section" hidden>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Banned</a>
              </li>
            </ul>
  
            <section class="row text-center placeholders">
              <div class="col-6 col-sm-3 placeholder">
                <a href="#Download">
                    <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="100" height="100" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                </a>
                <h4>Ban</h4>
                <span class="text-muted">Ban Selected User(s)</span>
              </div>
              <div class="col-6 col-sm-3 placeholder">
                <a href="#Delete">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="100" height="100" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
                </a>
                <h4>Reactivate</h4>
                <span class="text-muted">Reactivate Selected Users(s)</span>
              </div>
            </section>
            
            <!--Active File Table -->
            <h2>Allowed IPs</h2>
            <div class="table-responsive" id="fileList">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Select</th>
                    <thIPs</th>
                    <th>Location</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>10.128.1.168</td>
                    <td>Location</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>10.128.1.169</td>
                    <td>Location</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>10.128.1.170</td>
                    <td>Location</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- End IP section -->
          
          <div id="setting-section" hidden>
            <h2>Settings</h2>
            
            <!--Setting Management-->
            <div id="setting-data">
              
            </div>
          </div>
       
       
       
       
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <!-- Please do not remove the backlink to us unless you support us at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
              <p class="no-margin-bottom">2017 &copy; Your company. Design by <a href="https://bootstrapious.com">Bootstrapious</a>.</p>
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
  </body>
</html>