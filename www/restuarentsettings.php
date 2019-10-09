<?php
ob_start();

 include_once 'Resources/header.php';
 include_once 'Resources/functions.php';
 global $toneId, $toneName, $tonePath, $toneType;

//  error_reporting(-1);
//                     include "./_pdo.php";
//                     $db_file = "./db.db";
//                     PDO_Connect("sqlite:$db_file");
                  
                    
                    $data = PDO_FetchAll("SELECT * FROM ringtonelist");
                    $activeTone = PDO_FetchAll("SELECT * FROM activetone");
                    foreach($activeTone as $tone){
                      $toneDetails = PDO_FetchAll("SELECT * FROM ringtonelist WHERE toneid=".$tone['toneid']);
                    }
                    foreach($toneDetails as $toned){
                      $toneId = $toned['toneid'];
                      $toneName = $toned['tonename'];
                      $tonePath = $toned['tonepath'];
                      $toneType = $toned['tonetype'];
                    }
                    
?>

<form action="sql/apisave.php" method="post">

<!-- Api settings for orderlist -->
<div class="container" style="margin:40px; padding: 10px 10px;">

    <!-- Api setup start -->
    <h5>Restuarant Setting :</h5>
    <div class="row border-inner" >
        <div class="col-sm-12">
        <label for="basic-url">Restuarant Url</label>

        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon3">URL: </span>
        </div>
        <input type="text" name="url" value="<?php echo $url; ?>" class="form-control" id="basic-url" aria-describedby="basic-addon3">
        </div>

        <div class="alert alert-danger" role="alert">
            <strong>Note :</strong> Don't forget to add "/" after the end of the url
            </div>
        
        </div>
    <!-- api setup end -->
    </div>

    <br>
    
    <br><br>
    <div class="row">
    
        <!-- <div class="col-md-4"></div> -->
        <div class="col-md-12">
            <!-- <a type="button" class="form-control btn btn-primery" >Save</a> -->
            <input type="submit"  class="fadeIn fourth" style="width: 300px; align:center" value="Save" name="submit">
        </div>
    
    </div>

</div>
</form>

<script>

    

 </script>

<?php include_once 'Resources/footer.php';?>



