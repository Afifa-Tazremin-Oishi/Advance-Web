<html>
  <head>
  <title>Order Status Chart</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
 



      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
        <?php echo $orderStatusPieChartData?>
        ]);
        

        var options = {
          title: 'Order Status Chart',
          pieHole: 0.2,
         
          
        
        };

        var chart = new google.visualization.PieChart(document.getElementById("piechart_3d"));
        chart.draw(data, options);
        
        
      }
    </script>
    <style>
         body {
            max-width: 100%;
            overflow-x: hidden;
        }

    </style>
  </head>




<div class="row">
  

  
  <body>
    <div id="piechart_3d"style="width: 1000px; height: 500px;" ></div>
    <a href="http://localhost:3000/orderList" style =" color:white;background-image: linear-gradient(90deg, aqua, blue);border-radius: 10px; padding: 10px; border: 1px solid blue;">Back</a>

    
    
  </body>
  
 

</div>
  

  
</html>

