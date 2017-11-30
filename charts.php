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
    //select DATE_FORMAT( CURRENT_DATE - 1, '%M %D, %Y' )
    $arrD=array();
    for($i=0;$i<7;$i++){
        $arrD[]=$i+1;
    }
    
    
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
            curveType: 'function',
            legend: { position: 'bottom' },
            backgroundColor:{fill: '#212529',stroke:'blue',strokeWidth:2},
            chartArea:{
                backgroundColor:{
                    fill:'#2d3035',
                    stroke: 'black',
                    strokeWidth: 3
                },
                left:40,
                right:40
            },
            colors: ['#9900ff','#ff5050'],
            height:427,
            width: 814,
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
      }
    </script>
  </head>
  <body>
    <div id="curve_chart" style="width: 794px; height: 427px ; color:black"></div>
  </body>
</html>