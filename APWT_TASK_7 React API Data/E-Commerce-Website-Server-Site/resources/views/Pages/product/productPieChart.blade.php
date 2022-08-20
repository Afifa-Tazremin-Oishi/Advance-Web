<html>
  <head>
  <title>Product Chart</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
 



      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
        <?php echo $productPieChartData?>
        ]);
        

        var options = {
          title: 'Product Category Chart',
          is3D: true,
          
        
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





  

  
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
    <a href="http://localhost:3000/productList">Back</a>
  
         
  </body>
  
 


  
 
  
</html>

