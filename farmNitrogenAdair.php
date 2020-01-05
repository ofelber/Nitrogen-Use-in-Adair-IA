<?php

  // connect to database 
  //Old database connection that used postgres
  //$database = 'host=s-l112.engr.uiowa.edu dbname=postgres user=student6 password=engr-2018-6'; 
  //$connection = pg_connect($database);

  //New database connection in SQL Server
  $serverName = "server name"; //serverName\instanceName
  $connectionInfo = array( "Database"=>"[database name]", "UID"=>"sa", "PWD"=>"[password]");
  $conn = sqlsrv_connect( $serverName, $connectionInfo);

  //In the database 1 is nitrogen, fips_co 1 is Adair County, and location_type 1 is farm use
  $query = "SELECT amount FROM location_amount WHERE nutrient_type_id = 1 AND fips_co = 1 AND location_type_id = 1 ORDER BY year";
  
  //"pg" statements are for use in postgres, program has been modified for use in sql server
  //$result = pg_prepare($conn, "qry2", $query);
  //$result = pg_execute($conn, "qry2", array()); 
  $stmt = sqlsrv_query($conn, $query);
  
  $table = '[';
  //while ($myrow = pg_fetch_assoc($result)) {
  while ($myrow = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $table .= '' . $myrow['amount'] . ', ';
  }
  $table .= '0]';
    
?>
<style type="text/css">


canvas {
	border:1px solid black;
}

</style>

<canvas width="550" height="275" id="canvas1"></canvas>

<script type="text/javascript">

var data = <?php echo $table; ?>;
console.log(data.length);

var canvas = document.getElementById('canvas1');
var ctx = canvas.getContext('2d');

// This part needs to be adjusted depending on data used
var offx = 100;
var offy = 50;
var w = 8;
var h = 150;
var h2 = h+10;

// background box
ctx.fillStyle = 'rgba(150, 150, 150, 0.2)';
ctx.fillRect(offx, offy, (w+0)*50, h2);


// normalization of the data
var min=10000, max=0;
for (var i = 0; i < data.length-1; i++) {
  c = data[i];
  if (c>max) max=c;
  if (c<min) min=c; 
}

console.log(min, max);


// chart bar elements
ctx.fillStyle = 'rgba(0, 0, 200, 0.5)';
for (var i = 0; i < data.length-1; i++) {
  c = (data[i]-min+1)*(h/(max-min+2));
  ctx.fillRect(offx+(w+12.6)*i, offy+(h2-c), w, c);
}

// Line for line graph
//ctx.strokeStyle = "#8B0000";
//ctx.lineWidth = 2;
//ctx.beginPath();
  //for (var i = 1; i < dataset.length-1; i++){
    //ctx.moveTo(offx+i-1, offy+(y(i-1)*1.5)/1000000);
    //ctx.lineTo(ofx+i, offy+(y(i)*1.5)/1000000);
  //}
//ctx.stroke();

// border for box
ctx.fillStyle = 'rgba(0, 0, 0, 0.9)';
ctx.strokeRect(offx, offy, (w+0)*50, h2);


// tick marks / x axis
ctx.beginPath();
var tx = 0;
ctx.moveTo(offx+tx, offy+h2);
ctx.lineTo(offx+tx, offy+h2+10);
tx = tx + 100;
ctx.moveTo(offx+tx, offy+h2);
ctx.lineTo(offx+tx, offy+h2+10);
tx = tx + 100;
ctx.moveTo(offx+tx, offy+h2);
ctx.lineTo(offx+tx, offy+h2+10);
tx = tx + 100;
ctx.moveTo(offx+tx, offy+h2);
ctx.lineTo(offx+tx, offy+h2+10);
tx = tx + 100;
ctx.moveTo(offx+tx, offy+h2);
ctx.lineTo(offx+tx, offy+h2+10);
ctx.stroke();


// x axis labels
ctx.textAlign = "center";

ctx.fillStyle = 'black';
ctx.font = '20px Calibri';
ctx.fillText('Farm Nitrogen Fertilizer Use in Adair County (tons)', offx+200, offy-20);


ctx.fillStyle = 'black';
ctx.font = '14px Calibri';
tx = 0;
ctx.fillText('1987', offx+tx, offy+h2+25);
tx = tx + 100;
ctx.fillText('1991', offx+tx, offy+h2+25);
tx = tx + 100;
ctx.fillText('1996', offx+tx, offy+h2+25);
tx = tx + 100;
ctx.fillText('2000', offx+tx, offy+h2+25);
tx = tx + 100;
ctx.fillText('2006', offx+tx, offy+h2+25);

// tick marks / y axis
ctx.beginPath();
var ty = 0;
ctx.moveTo(offx, offy);
ctx.lineTo(offx-10, offy);
ty = ty + 42;
ctx.moveTo(offx, offy+ty);
ctx.lineTo(offx-5, offy+ty);
ty = ty + 42;
ctx.moveTo(offx, offy+ty);
ctx.lineTo(offx-10, offy+ty);
ty = ty + 42;
ctx.moveTo(offx, offy+ty);
ctx.lineTo(offx-5, offy+ty);
ctx.stroke();

ctx.textAlign = "right";
ty = 4;
ctx.fillText('8,000,000', offx-15, offy+ty);
ty = ty + 42;
ctx.fillText('', offx-15, offy+ty);
ty = ty + 42;
ctx.fillText('4,000,000', offx-15, offy+ty);
ty = ty + 42;
ctx.fillText('', offx-15, offy+ty);
ty = ty + 50;


// REFERENCE

//ctx.fillStyle = 'rgb(200, 0, 0)';
ctx.strokeStyle = 'rgb(0, 0, 200)';
ctx.fillStyle = 'rgba(0, 0, 200, 0.5)';

ctx.beginPath();
ctx.moveTo(275, 250);
ctx.lineTo(400, 375);
ctx.lineTo(400, 125);
ctx.lineTo(275, 250);


ctx.fillStyle = 'rgba(200, 0, 0, 0.5)';
ctx.beginPath();
ctx.moveTo(175, 250);
ctx.lineTo(300, 375);
ctx.lineTo(300, 125);
ctx.lineTo(175, 250);


ctx.strokeStyle = 'rgb(0, 0, 0)';
ctx.fillStyle = 'rgba(0, 200, 0, 0.5)';


ctx.beginPath();
ctx.arc(175, 175, 150, 0, Math.PI/2, true);
//ctx.stroke();

ctx.beginPath();
ctx.arc(275, 275, 150, 0, Math.PI/2, false);
//ctx.stroke();


ctx.strokeStyle = 'red';
ctx.strokeStyle = '#FF0000';

var rectangle = new Path2D();
rectangle.rect(10, 10, 50, 50);
//ctx.stroke(rectangle);

  // ctx.setLineDash([4, 8]);
  // ctx.lineDashOffset = 0;
  // ctx.lineWidth = 1;

for (var i = 0; i < 6; i++) {
  for (var j = 0; j < 6; j++) {
    ctx.fillStyle = 'rgb(' + Math.floor(255 - 42.5 * i) + ', ' + Math.floor(255 - 42.5 * j) + ', 0)';
    //ctx.fillRect(100+j * 50, 100+i * 50, 50, 50);
  }
}

  var lingrad = ctx.createLinearGradient(100, 100, 350, 350);
  lingrad.addColorStop(0, '#FF0000');
  lingrad.addColorStop(0.5, '#FFFFFF');
  lingrad.addColorStop(1, '#0000FF');

  ctx.fillStyle = lingrad;
  //ctx.fillRect(100, 100, 250, 250);


  
  ctx.font = '20px Times New Roman';
  ctx.fillStyle = 'Black';
  ctx.textAlign = "center";
  //ctx.fillText('Informatics', 100, 100);

  ctx.beginPath();
  ctx.moveTo(100, 105);
  ctx.lineTo(100, 120);
  ctx.closePath();
  //ctx.stroke();


</script>

