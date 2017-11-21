<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Dark Bootstrap Admin by Bootstrapious.com</title>
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
            <link rel="stylesheet" href="/Landing/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="cssL/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,600|Raleway:600,300|Josefin+Slab:400,700,600italic,600,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="cssL/slick-team-slider.css" />
    <link rel="stylesheet" type="text/css" href="cssL/style.css">
    <link href="dashboard.css" rel="stylesheet">
    
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
      }
      
      function showUserSection(){
        hideEverything();
        var userSection = document.getElementById('user-section');
        userSection.hidden = false;
      }
      
      function showFileSection(){
        hideEverything();
        var fileSection = document.getElementById('file-section');
        fileSection.hidden = false;
      }
      
      function showIpSection(){
        hideEverything();
        var ipSection = document.getElementById('ip-section');
        ipSection.hidden = false;
      }
      
      function showSettingSection(){
        hideEverything();
        var settingSection = document.getElementById('setting-section');
        settingSection.hidden = false;
      }
      
      function hideEverything(){
        var homeSection = document.getElementById('home-section');
        var userSection = document.getElementById('user-section');
        var fileSection = document.getElementById('file-section');
        var ipSection = document.getElementById('ip-section');
        var settingSection = document.getElementById('setting-section');
        
        homeSection.hidden = true;
        userSection.hidden = true;
        fileSection.hidden = true;
        ipSection.hidden = true;
        settingSection.hidden = true;
      }
      
    </script>
  </head>
  <body>
    <header class="header">  
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <a class="navbar-brand" href="index.html" id="dashboardLogo"><img src="./images/logo.ico" width="25px" height="25px"> Doc -> Dash</a>
            <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
             </button>
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto" id="links1">
                    <li class="nav-item">
                        <!--<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>-->
                        <a class="nav-link" href="./index.html"><i class="fa fa-home" aria-hidden="true"></i> Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./ur-user.html" target="_blank"><i class="fa fa-paper-plane" aria-hidden="true"></i> Quick Send</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" id="links2">
                    <li class="nav-item">
                        <a class="nav-link" href="./login.html"><i class="fa fa-sign-in" aria-hidden="true"></i> Login/Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./about.html"><i class="fa fa-info-circle" aria-hidden="true"></i> About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./contact.html"><i class="fa fa-address-book" aria-hidden="true"></i> Contact Us</a>
                    </li>
                </ul>
        </nav>
    </header> 
    
   
    
    
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
          <li> <a onclick="showFileSection()"> <i class="fa fa-bar-chart"></i>Files </a></li>
          <li> <a onclick="showIpSection()"> <i class="icon-padnote"></i>IPs </a></li>
          <li> <a onclick="showSettingSection()"> <i class="icon-padnote"></i>Settings </a></li>
          <li> <a href="login.html"> <i class="icon-logout"></i>Login Page</a></li>
        </ul>
      </nav>
      <div class="page-content">
        
      
        
        <!-- Begin Home Section-->
        <div id="home-section" hidden>
          
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
        <div id="message-section">
         <div class="page-header">
            <div class="container-fluid">
              <h2 class="h5 no-margin-bottom">Messages</h2>
            </div>
          </div>
            <div class="table-responsive" id="fileList">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Select</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>masterprogrammer200</td>
                    <td>Matthew</td>
                    <td>matt@ipfw.edu</td>
                  </tr>
                </tbody>
              </table>
            </div>
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
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>masterprogrammer200</td>
                    <td>Matthew</td>
                    <td>matt@ipfw.edu</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>AhhhYeah</td>
                    <td>Annesh</td>
                    <td>annesh@ipfw.edu</td>
                  </tr>
                  <tr>
                    <td><input type="checkbox" name="selected"/></td>
                    <td>joelIzKing</td>
                    <td>Joel</td>
                    <td>joel@ipfw.edu</td>
                  </tr>
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