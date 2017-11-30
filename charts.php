<?php
    $arrD=array(
    0  => 1,
    1 => 2,
    2 => 3,
    3 => 4,
    4 => 5,
    5 =>6,
    6 =>7);
  
    
    require('database.php');
    $connection=dbConnect();
    
    //$sql="select count(id) from users where dateActive>=CURRENT_DATE-7; ";
    
    $arrU=array();
    for($i=0;$i<7;$i++){
        $sql="select count(id) from users where dateActive=CURRENT_DATE-($i+1); ";
        if($result=mysqli_query($connection,$sql)){
            $row=mysqli_fetch_assoc($result);
            $x=intVal($row['count(id)']);
            $arrU[]=$x;
        }
    }
    
    $arrF=array();
    for($i=0;$i<7;$i++){
        $sql="select count(id) from files where upload_date=CURRENT_DATE-($i+1); ";
        $sql="select count(id) from transactions where fuploadDate=CURRENT_DATE-($i+1); ";
        if($result=mysqli_query($connection,$sql)){
            $row=mysqli_fetch_assoc($result);
            $x=intVal($row['count(id)']);
            $arrF[]=$x;
        }
    }
?>
<html>
  <head>
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
        var arr=[];
        arr[0]=['Day','Users','Files'];
        for(var i=0;i<7;i++){
            arr[i+1]=[arrDay[i],arrUsers[i],arrFiles[i]];
        }
        
        var data=google.visualization.arrayToDataTable(arr);
        var options = {
          title: 'Website Usage',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>