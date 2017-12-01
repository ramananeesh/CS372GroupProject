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
   
   /*
   if(isset($_POST['action']) && $_POST['action'] == "banUser"){
     
      $usersToBan = $_POST['user-id'];
      
      if (isset($_POST['user-id'])) {
          
          foreach ($usersToBan as $user){
              
              $sql = sprintf("UPDATE users SET banned=1 WHERE id='%s'",
              $connection->real_escape_string($user));
            
              // execute query
              $result = $connection->query($sql) or die(mysqli_error($connection));
              
              if ($result === false)
                  die("Could not query database");
              
          }
          
      } else {
          echo "You did not choose a message.";
      }
    }
    else if(isset($_POST['action']) && $_POST['action'] == "reactivateUser"){
     
      $usersToReactivate = $_POST['user-id'];
      
      if (isset($_POST['user-id'])) {
          
          foreach ($usersToReactivate as $user){
              
              $sql = sprintf("UPDATE users SET banned=0 WHERE id='%s'",
              $connection->real_escape_string($user));
            
              // execute query
              $result = $connection->query($sql) or die(mysqli_error($connection));
              
              if ($result === false)
                  die("Could not query database");
              
          }
          
      } else {
          echo "You did not choose a message.";
      }
    }
   else if(isset($_POST['action']) && $_POST['action'] == "deleteMessage"){
     
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
    } else if(isset($_POST['action']) && $_POST['action'] == "deleteFile"){
     
      $filesToDelete = $_POST['files-id'];
      
      if (isset($_POST['files-id'])) {
          
          foreach ($messagesToDelete as $message){
              
              $sql = sprintf("DELETE FROM file WHERE id = '%s'",
              $connection->real_escape_string($file));
            
              // execute query
              $result = $connection->query($sql) or die(mysqli_error($connection));
              
              if ($result === false)
                  die("Could not query database");
              
          }
          
      } else {
          echo "You did not choose a file.";
      }
    }
    */
    
    $sql="select count(id) as noUsers from users";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noUsers=$row['noUsers'];
    //echo "<script>alert(\"No of users : $noUsers\")</script>";
    $sql="select count(id) as noFiles from files";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noFiles=$row['noFiles'];
    
    $sql="select count(id) as noNewFiles from files where upload_date=CURRENT_DATE";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noNewFiles=$row['noNewFiles'];
    
    $sql="select count(id) as noNewUsers from users where dateActive=CURRENT_DATE";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noNewUsers=$row['noNewUsers'];
    
    $sql="select count(id) as noMessages from contact where active=1";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noMessages=$row['noMessages'];
    
    $sql="select count(id) as noNewMessages from contact where active=1 and date(time_stamp)=CURRENT_DATE";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noNewMessages=$row['noNewMessages'];
    
    $sql="select count(id) as noDownloads from transactions where upload=1";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noDownloads=$row['noDownloads'];
    
    $sql="select count(id) as noBannedUsers from users where banned=1";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noBannedUsers=$row['noBannedUsers'];
?>
<?php
    require('database.php');
    $connection=dbConnect();
    
    //$sql="select count(id) from users where dateActive>=CURRENT_DATE-7; ";
    //select DATE_FORMAT( CURRENT_DATE - 1, '%M %D, %Y' )
    $arrD=array();
    for($i=0;$i<7;$i++){
        $arrD[]=$i+1;
    }
   
    
    $arrU=array();
    $c=6;
    for($i=0;$i<7;$i++){
        $sql="select count(id) from users where dateActive=DATE_SUB(CURRENT_DATE,INTERVAL $c DAY); ";
        if($result=mysqli_query($connection,$sql)){
            $row=mysqli_fetch_assoc($result);
            $x=intVal($row['count(id)']);
            $arrU[]=$x;
            $c--;
        }
    }
    //echo "<script>alert($arrU[2])</script>";
    $arrF=array();
    $c=6;
    for($i=0;$i<7;$i++){
        $date=date("Y-m-d")-$i;
        $sql="select count(id) from transactions where fuploadDate=DATE_SUB(CURRENT_DATE,INTERVAL $c DAY) ";
        if($result=mysqli_query($connection,$sql)){
            $row=mysqli_fetch_assoc($result);
            $x=intVal($row['count(id)']);
            $arrF[]=$x;
        }
        $c--;
    }
    
    $arrM=array();
    $c=6;
    for($i=0;$i<7;$i++){
    
      $sql="select count(id) from contact where date(time_stamp)=DATE_SUB(CURRENT_DATE,INTERVAL $c DAY) ";
        if($result=mysqli_query($connection,$sql)){
            $row=mysqli_fetch_assoc($result);
            $x=intVal($row['count(id)']);
            $arrM[]=$x;
            $c--;
        }
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
    

    
    <script>
      
      function showHomeSection(){
        hideEverything();
        var homeSection = document.getElementById('home-section');
        homeSection.hidden = false;
        document.getElementById('homeNav').classList.add("active");
      }
      
      function showMessageSection(){
        hideEverything();
        var messageSection = document.getElementById('message-section');
        messageSection.hidden = false;
        document.getElementById('msgNav').classList.add("active");
      }
      
      function showUserSection(){
        hideEverything();
        var userSection = document.getElementById('user-section');
        userSection.hidden = false;
        document.getElementById('userNav').classList.add("active");
      }
      
      function showFileSection(){
        hideEverything();
        var fileSection = document.getElementById('file-section');
        fileSection.hidden = false;
        document.getElementById('fileNav').classList.add("active");
      }
      
      function showIpSection(){
        hideEverything();
        var ipSection = document.getElementById('ip-section');
        ipSection.hidden = false;
        document.getElementById('ipNav').classList.add("active");
      }
      
      function showSettingSection(){
        hideEverything();
        var settingSection = document.getElementById('setting-section');
        settingSection.hidden = false;
        document.getElementById('settingNav').classList.add("active");
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
          
        document.getElementById('homeNav').classList.remove("active");
        document.getElementById('userNav').classList.remove("active");
        document.getElementById('msgNav').classList.remove("active");
        document.getElementById('fileNav').classList.remove("active");
        document.getElementById('ipNav').classList.remove("active");
        document.getElementById('settingNav').classList.remove("active");
      }
      
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        //var arrDay=[1,2,3,4,5,6,7];
        var arrDay=JSON.parse('<?php echo json_encode($arrD); ?>');
        //var arrUsers=[10,2,4,8,12,6,5];
        var arrUsers=JSON.parse('<?php echo json_encode($arrU); ?>');
        //var arrFiles=[8,2,4,7,6,12,14];
        var arrFiles=JSON.parse('<?php echo json_encode($arrF); ?>');
        var arrMessages=JSON.parse('<?php echo json_encode($arrM); ?>');
        var arr=[];
        arr[0]=['Day','New Users','New Files'];
        for(var i=0;i<7;i++){
            arr[i+1]=[arrDay[i],arrUsers[i],arrFiles[i]];
        }
        
        var data=google.visualization.arrayToDataTable(arr);
        var options = {
            curveType: 'function',
            legend: { position: 'bottom' },
            backgroundColor:{fill: '#212529',stroke:'transparent',strokeWidth:2},
            chartArea:{
                backgroundColor:{
                    fill:'#2d3035',
                    stroke: 'black',
                    strokeWidth: 3
                },
                left:40,
                right:40
            },
            colors: ['#e95f71','#CF53F9'],
            height:357,
            width: 614,
            lineWidth:1.5,
            legend: {position: 'top',alignment:'center', textStyle: {color: '#b8b894', fontSize: 16}},
            hAxis:{
                //title: 'Day',
                titleTextStyle: {
                color: '#8a8d93',
                bold:true
                },
                gridlines:{color:'transparent'},
                baselineColor: 'black',
                minValue:1
            },
            vAxis:{
                //title: 'Number',
                titleTextStyle: {
                color: '#8a8d93',
                bold:true
                },
                gridlines:{color:'transparent'},
                baselineColor: 'black',
            }
            
        };

        var chart = new google.visualization.ScatterChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
        
        var arr2=[];
        arr2[0]=['Day','Messages'];
        for(var i=0;i<7;i++){
            arr2[i+1]=[arrDay[i],arrMessages[i]];
        }
        
        var data2=google.visualization.arrayToDataTable(arr2);
        var option2={
          title: 'Messages Received',
          titleTextStyle:{
            color: '#8a8d93',
            alignment:'center',
            fontSize:12,
          },
          colors: ['#864DD9','#ff5050'],
          backgroundColor:{fill: '#212529',stroke:'transparent',strokeWidth:2},
          //legend: { position: 'none' },
          legend: {position: 'top',alignment:'end', textStyle: {color: '#b8b894', fontSize: 10}},
          hAxis:{
            gridlines:{color:'transparent'},
            baselineColor: 'black',
          },
          vAxis:{
            gridlines:{color:'transparent'},
          }
        };
        var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        
        chart2.draw(data2, option2);
      }
    </script>
  </head>
  <body>
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
          <li> <a href="sessionEnd.php"> <i class="fa fa-sign-out"></i>Login Page</a></li>
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
                          <div class="icon"><i class="icon-user-1"></i></div><strong>Total Users</strong>
                        </div>
                        <div class="number dashtext-1"><?php echo $noUsers; ?></div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style=<?php $width=($noUsers/100)*100; echo "\"width: $width%\""; ?> aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="icon-contract"></i></div><strong>New Files</strong>
                        </div>
                        <div class="number dashtext-2"><?php echo $noNewFiles;?></div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style=<?php $width=($noNewFiles/$noFiles)*100; echo "\"width: $width%\""; ?> aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-2"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="icon-paper-and-pencil"></i></div><strong>New Users</strong>
                        </div>
                        <div class="number dashtext-3"><?php echo $noNewUsers;?></div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style=<?php $width=($noNewUsers/$noUsers)*100; echo "\"width: $width%\""; ?> aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-3"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="icon-writing-whiteboard"></i></div><strong>All Files</strong>
                        </div>
                        <div class="number dashtext-4"><?php echo $noFiles;?></div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style=<?php $width=($noFiles/100)*100; echo "\"width: $width%\""; ?> aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-4"></div>
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
                      <!--<canvas id="barChartExample1"></canvas>-->
                      <div id="chart_div"></div>
                    </div>
                    <div class="bar-chart block">
                      <canvas id="barChartExample2"></canvas>
                      
                    </div>
                  </div>
                  <div class="col-lg-5">
                    
                      <!--<canvas id="lineCahrt"></canvas>-->
                      <div id="curve_chart"></div>
                    
                  </div>
                  <div class="col-md-3 col-sm-6">
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="fa fa-user-times"></i></div><strong>Banned Users</strong>
                        </div>
                        <div class="number dashtext-3"><?php echo $noBannedUsers; ?></div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style=<?php $width=($noBannedUsers/$noUsers)*100; echo "\"width: $width%\""; ?> aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-3"></div>
                      </div>
                    </div>
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="fa fa-cloud-download"></i></div><strong>Total Downloads</strong>
                        </div>
                        <div class="number dashtext-1"><?php echo $noDownloads; ?></div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style=<?php $width=($noDownloads/100)*100; echo "\"width: $width%\""; ?> aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-1"></div>
                      </div>
                    </div>
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="fa fa-comments"></i></div><strong>New Messages</strong>
                        </div>
                        <div class="number dashtext-2"><?php echo $noNewMessages; ?></div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style=<?php $width=($noNewMessages/$noMessages)*100; echo "\"width: $width%\""; ?> aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-2"></div>
                      </div>
                    </div>
                    <div class="statistic-block block">
                      <div class="progress-details d-flex align-items-end justify-content-between">
                        <div class="title">
                          <div class="icon"><i class="fa fa-inbox"></i></div><strong>Total Messages</strong>
                        </div>
                        <div class="number dashtext-4"><?php echo $noMessages; ?></div>
                      </div>
                      <div class="progress">
                        <div role="progressbar" style=<?php $width=($noMessages/100)*100; echo "\"width: $width%\""; ?> aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" class="progress-bar dashbg-4"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
        </div>
        <!-- End Home Section -->
        
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
           

             <div class="page-header">
            <div class="container-fluid">
              <h2 class="h5 no-margin-bottom">Users</h2>
            </div>
          </div>
           
           <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link active" href="#">Active</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Banned</a>
              </li>
            </ul>
            <form onsubmit="banUser(); return false;">
            <section class="row text-center placeholders">
              <div class="col-6 col-sm-3 placeholder" id="divBan">
                <a href="#Ban">
                  <input type="hidden" name="action" value="banUser">
                  <input type="image" src="./images/delete icon.jpg" width="100" height="100" class="img-fluid rounded-circle" alt="Ban Button"/>
                </a>
                <h4>Ban</h4>
                <span class="text-muted">Ban Selected Users(s)</span>
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
                    
                      $sql = sprintf("Select * FROM users WHERE banned = 0 ORDER BY username");
    
                      // execute query
                      $result = $connection->query($sql) or die(mysqli_error());   
    
                      // check whether we found a row
                      while ($user= $result->fetch_assoc())
                      {
                          echo "<tr>";
                          echo "<td><input type='checkbox' id='user-id' name='user-id[]' value='".$user["id"]."'/></td>";
                          echo "<td>".$user["username"]."</td>";
                          echo "<td>".$user["name"]."</td>";
                          echo "<td>".$user["email"]."</td>";
                          echo "<td>".$user["dateActive"]."</td>";
                          echo "</tr>";
                      }
                    ?>
                </tbody>
              </table>
              
            </div>
            
            

            </form>
            
            <form action="" method="post">
            <section class="row text-center placeholders">
              <div class="col-6 col-sm-3 placeholder" id="divReactivate">
                <a href="#Reactivate">
                  <input type="hidden" name="action" value="reactivateUser">
                  <input type="image" src="./images/uploadicon.png" width="100" height="100" class="img-fluid rounded-circle" alt="Reactivate Button"/>
                </a>
                <h4>Reactivate</h4>
                <span class="text-muted">Reactivate Selected Users(s)</span>
              </div>
            </section>
            <h2>Banned User List</h2>
            <div class="table-responsive" id="bannedUserList">
              
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
                    
                      $sql = sprintf("Select * FROM users WHERE banned = 1 ORDER BY username");
    
                      // execute query
                      $result = $connection->query($sql) or die(mysqli_error());   
    
                      // check whether we found a row
                      while ($user= $result->fetch_assoc())
                      {
                          echo "<tr>";
                          echo "<td><input type='checkbox' id='user-id' name='user-id[]' value='".$user["id"]."'/></td>";
                          echo "<td>".$user["username"]."</td>";
                          echo "<td>".$user["name"]."</td>";
                          echo "<td>".$user["email"]."</td>";
                          echo "<td>".$user["dateActive"]."</td>";
                          echo "</tr>";
                      }
                    ?>
                </tbody>
              </table>
              
            </div>
            </form>
            
            
          </div>
          <!--End users section-->
          
          
          <!--File section -->
          <div id="file-section" hidden>
             <div class="page-header">
            <div class="container-fluid">
              <h2 class="h5 no-margin-bottom">Files</h2>
            </div>
          </div>
          
          <form action="<?= $_SERVER["PHP_SELF"] ?>" method="post">
          <section class="row text-center placeholders">
              <div class="col-6 col-sm-3 placeholder" id="divDelete">
           
              <a href="#Delete">
                <!--button id="delete" type="submit"-->
                <!-- img src="./images/delete icon.jpg" name="delete" width="100" height="100" class="img-fluid rounded-circle" alt="Delete Button" -->
                <input type="hidden" name="action" value="deleteFile">
                <input type="image" src="./images/delete icon.jpg" width="100" height="100" class="img-fluid rounded-circle" alt="Delete Button" />
                <!--/button-->
              </a>
              <h4>Delete</h4>
              <span class="text-muted">Delete Selected Files(s)</span>
            
          </div>
            </section>
          
            <div class="table-responsive" id="fileList">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Select</th>
                    <th>File Name</th>
                    <th>Size</th>
                    <th>Created Date</th>
                  </tr>
                </thead>
                <tbody>
                   <?php
                      
                      // read
                    
                      $sql = sprintf("Select * FROM files ORDER BY upload_date DESC");
    
                      // execute query
                      $result = $connection->query($sql) or die(mysqli_error());   
    
                      // check whether we found a row
                      while ($file= $result->fetch_assoc())
                      {
                          echo "<tr>";
                          echo "<td><input type='checkbox' id='file-id' name='file-id[]' value='".$file["id"]."'/></td>";
                          echo "<td>".$file["fname"]."</td>";
                          echo "<td>".$file["size"]."</td>";
                          echo "<td>".$file["upload_date"]."</td>";
                          echo "</tr>";
                      }
                    ?>
                </tbody>
              </table>
            </div>
            </form>
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
    <script src="./js/jquery-1.11.0.min.js"></script>
    <script src="./js/admin.js"></script>
  </body>
</html>