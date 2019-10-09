<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <meta http-equiv="refresh" content="30" /> -->
<title>PHP Desktop Demo Project</title>

<?php 
include 'Resources/links.php';

?>

<script>
function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  var ampm;
if (h >= 12) {
    ampm = "PM";
    h-=12;
} else {
    ampm = "AM";
}
  document.getElementById('txt').innerHTML =
  h + ":" + m + ":" + s +" "+ ampm;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
</head>
<body onload="startTime()">
<header>
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light w3-teal ">
    <a class="navbar-brand" href="index.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home</a>
  <div class="header-right">
    <!-- <a href="<?php echo $_SERVER["REQUEST_URI"];?>">PHP Desktop Aplication Demo</a> -->
    
  </div>
  <form class="form-inline">
      <div class="md-form my-0 animated pulse delay-5s" >
        <div class="digital_clock">
          <div id="txt" class="clock_text">12:00 AM</div>
        </div>
        
        </div>
  </form>
  
  </nav>
</div>
<!-- <div class="w3-container w3-teal">
    <a  class="navbar-brand" style="margin-top: -10px;" href="index.php"><i class="fa fa-home" aria-hidden="true"></i>&nbsp; Home</a>
</div> -->
</header>
