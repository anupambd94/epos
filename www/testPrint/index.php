<?php 



?>


<style type="text/css">@import url("style.css");</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<a href="<?php echo $_SERVER["REQUEST_URI"];?>">Refresh</a>



<title>PHP Desktop Chrome</title>

<div class="container">

    <div class="wapper">
    
    <div class="jumbotron">
  <h1 class="display-4">Printing Test</h1>
  <p class="lead">This is a simple test page for printing with thermal printer. Please set the printer as default printer  by which you want to print.</p>

  <hr class="my-4">
  <p>Enter The Printer Sharer Name Here:</p>

  <form method="post" action="/vendor/mike42/escpos-php/example/interface/windows-usb.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Printer Sharer Name</label>
    <input type="text" class="form-control" name="sharerName" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Printer Sharer Name">
    <small id="emailHelp" class="form-text text-muted">You'll find is in printer settings.</small>
  </div>
  
  <button type="submit" class="btn btn-primary">Test Print</button>
</form>
</div>
    </div>

</div>


<hr>


