<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var arrDay=[1,2,3,4,5,6,7];
        var arrUsers=[10,2,4,8,12,6,5];
        var arrFiles=[8,2,4,7,6,12,14];
        var arr=[];
        arr[0]=['Day','Users','Files'];
        for(var i=0;i<7;i++){
            arr[i+1]=[arrDay[i],arrUsers[i],arrFiles[i]];
        }
        alert("Hi " +arr[0]);
        /*var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);*/
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