<?php

    require_once('../../db_connect.php');
    $connection = connect_to_db();

    $sql="select count(id) as noUsers from users";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noUsers=htmlspecialchars($row['noUsers']);
    //echo "<script>alert(\"No of users : $noUsers\")</script>";
    $sql="select count(id) as noFiles from files";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noFiles=htmlspecialchars($row['noFiles']);
    
    $sql="select count(id) as noNewFiles from files where date(upload_date)=CURRENT_DATE";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noNewFiles=htmlspecialchars($row['noNewFiles']);
    
    $sql="select count(id) as noNewUsers from users where dateActive=CURRENT_DATE";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noNewUsers=htmlspecialchars($row['noNewUsers']);
    
    $sql="select count(id) as noMessages from contact where active=1";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noMessages=htmlspecialchars($row['noMessages']);
    
    $sql="select count(id) as noNewMessages from contact where active=1 and date(time_stamp)=CURRENT_DATE";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noNewMessages=htmlspecialchars($row['noNewMessages']);
    
    $sql="select count(id) as noDownloads from transactions where upload=1";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noDownloads=htmlspecialchars($row['noDownloads']);
    
    $sql="select count(id) as noBannedUsers from users where banned=1";
    $result=$connection->query($sql) or die(mysqli_error($connection));
    $row=mysqli_fetch_assoc($result);
    $noBannedUsers=htmlspecialchars($row['noBannedUsers']);
    
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
    
    $arrDown=array();
    $c=6;
    for($i=0;$i<7;$i++){
      $sql="select count(id) from transactions where upload=0 and date(time_stamp)=DATE_SUB(CURRENT_DATE,INTERVAL $c DAY)";
      if($result=mysqli_query($connection,$sql)){
            $row=mysqli_fetch_assoc($result);
            $x=intVal($row['count(id)']);
            $arrDown[]=$x;
            $c--;
        }
    }
    
    echo "
    
    <script type='text/javascript'>
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        //var arrDay=[1,2,3,4,5,6,7];
        var arrDay=JSON.parse('".json_encode($arrD)."');
        //var arrUsers=[10,2,4,8,12,6,5];
        var arrUsers=JSON.parse('".json_encode($arrU)."');
        //var arrFiles=[8,2,4,7,6,12,14];
        var arrFiles=JSON.parse('".json_encode($arrF)."');
        var arrMessages=JSON.parse('".json_encode($arrM)."');
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
                left:20,
                right:5,
                top:20
            },
            colors: ['#e95f71','#CF53F9'],
            height:357,
            width: 450,
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
      </script>";
      
    //     echo"<script>
        
    //   }
    // </script>";
    
    echo "<div class='page-header'>
            <div class='container-fluid'>
              <h2 class='h5 no-margin-bottom'>Dashboard</h2>
            </div>
          </div>
            <section class='no-padding-top no-padding-bottom'>
              <div class='container-fluid'>
                <div class='row'>
                  <div class='col-md-3 col-sm-6'>
                    <div class='statistic-block block'>
                      <div class='progress-details d-flex align-items-end justify-content-between'>
                        <div class='title'>
                          <div class='icon'><i class='icon-user-1'></i></div><strong>Total Users</strong>
                        </div>
                        <div class='number dashtext-1'>".$noUsers."</div>
                      </div>
                      <div class='progress'>";
                      $width=($noUsers/100)*100;
                        echo "<div role='progressbar' style='width:".$width."%'aria-valuenow='30' aria-valuemin='0' aria-valuemax='100' class='progress-bar dashbg-1'></div>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-3 col-sm-6'>
                    <div class='statistic-block block'>
                      <div class='progress-details d-flex align-items-end justify-content-between'>
                        <div class='title'>
                          <div class='icon'><i class='icon-contract'></i></div><strong>New Files</strong>
                        </div>
                        <div class='number dashtext-2'>".$noNewFiles."</div>
                      </div>
                      <div class='progress'>";
                      $width=($noNewFiles/$noFiles)*100;
                        echo "<div role='progressbar' style='width:".$width."%' aria-valuenow='70' aria-valuemin='0' aria-valuemax='100' class='progress-bar dashbg-2'></div>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-3 col-sm-6'>
                    <div class='statistic-block block'>
                      <div class='progress-details d-flex align-items-end justify-content-between'>
                        <div class='title'>
                          <div class='icon'><i class='icon-paper-and-pencil'></i></div><strong>New Users</strong>
                        </div>
                        <div class='number dashtext-3'>".$noNewUsers."</div>
                      </div>
                      <div class='progress'>";
                      $width=($noNewUsers/$noUsers)*100;
                        echo "<div role='progressbar' style='width:".$width."%' aria-valuenow='55' aria-valuemin='0' aria-valuemax='100' class='progress-bar dashbg-3'></div>
                      </div>
                    </div>
                  </div>
                  <div class='col-md-3 col-sm-6'>
                    <div class='statistic-block block'>
                      <div class='progress-details d-flex align-items-end justify-content-between'>
                        <div class='title'>
                          <div class='icon'><i class='icon-writing-whiteboard'></i></div><strong>All Files</strong>
                        </div>
                        <div class='number dashtext-4'>".$noFiles."</div>
                      </div>
                      <div class='progress'>";
                      $width=($noFiles/100)*100;
                      echo "
                        <div role='progressbar' style='width:".$width."%' aria-valuenow='35' aria-valuemin='0' aria-valuemax='100' class='progress-bar dashbg-4'></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <section class='no-padding-bottom'>
              <div class='container-fluid'>
                <div class='row'>
                  <div class='col-md-3'>
                    <div class='bar-chart block no-margin-bottom'>
                      <div id='chart_div'></div>
                    </div>
                  </div>
                  <div class='col-md-6' id='curve_chart'>
                    
                      <!--<canvas id='lineCahrt'></canvas>-->
                      <!--<div id='curve_chart'></div>-->
                    
                  </div>
                  <div class='col-md-3 col-sm-3'>
                    <div class='statistic-block block'>
                      <div class='progress-details d-flex align-items-end justify-content-between'>
                        <div class='title'>
                          <div class='icon'><i class='fa fa-user-times'></i></div><strong>Banned Users</strong>
                        </div>
                        <div class='number dashtext-3'>".$noBannedUsers."</div>
                      </div>
                      <div class='progress'>";
                      $width=($noBannedUsers/$noUsers)*100;
                      echo "
                        <div role='progressbar' style='width:".$width."%' aria-valuenow='90' aria-valuemin='0' aria-valuemax='100' class='progress-bar dashbg-3'></div>
                      </div>
                    </div>
                    <div class='statistic-block block'>
                      <div class='progress-details d-flex align-items-end justify-content-between'>
                        <div class='title'>
                          <div class='icon'><i class='fa fa-cloud-download'></i></div><strong>Total Downloads</strong>
                        </div>
                        <div class='number dashtext-1'>".$noDownloads."</div>
                      </div>
                      <div class='progress'>";
                      $width=($noDownloads/100)*100;
                      echo "
                        <div role='progressbar' style='width:".$width."%' aria-valuenow='30' aria-valuemin='0' aria-valuemax='100' class='progress-bar dashbg-1'></div>
                      </div>
                    </div>
                    <div class='statistic-block block'>
                      <div class='progress-details d-flex align-items-end justify-content-between'>
                        <div class='title'>
                          <div class='icon'><i class='fa fa-comments'></i></div><strong>New Messages</strong>
                        </div>
                        <div class='number dashtext-2'>".$noNewMessages."</div>
                      </div>
                      <div class='progress'>";
                      $width=($noNewMessages/$noMessages)*100;
                      echo "
                        <div role='progressbar' style='width:".$width."%' aria-valuenow='30' aria-valuemin='0' aria-valuemax='100' class='progress-bar dashbg-2'></div>
                      </div>
                    </div>
                    <div class='statistic-block block'>
                      <div class='progress-details d-flex align-items-end justify-content-between'>
                        <div class='title'>
                          <div class='icon'><i class='fa fa-inbox'></i></div><strong>Total Messages</strong>
                        </div>
                        <div class='number dashtext-4'>".$noMessages."</div>
                      </div>
                      <div class='progress'>";
                      $width=($noMessages/100)*100;
                      echo "
                        <div role='progressbar' style='width:". $width."%' aria-valuenow='30' aria-valuemin='0' aria-valuemax='100' class='progress-bar dashbg-4'></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>";
    
?>