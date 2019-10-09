<?php 
ob_start();
$id = $_REQUEST['id'];


if($id != ""){
  // updatePrintStatus($id);
}
global $toneId, $toneName, $tonePath, $toneType;
error_reporting(-1);
                    include "./_pdo.php";
                    $db_file = "./db.db";
                    PDO_Connect("sqlite:$db_file");
                  
                    
                    $data = PDO_FetchAll("SELECT * FROM activetone");
                    foreach($data as $tone){
                      $toneDetails = PDO_FetchAll("SELECT * FROM ringtonelist WHERE toneid=".$tone['toneid']);
                    }
                    foreach($toneDetails as $toned){
                      $toneId = $toned['toneid'];
                      $toneName = $toned['tonename'];
                      $tonePath = $toned['tonepath'];
                      $toneType = $toned['tonetype'];
                    }

                    // echo $tonePath;
                    // exit;

// echo "Id is: ". $id;
?>
<?php include 'Resources/links.php' ?>

<div class="container">
    <div class="wrapper">
      <div class="row">

        <div class="col-md-12">
          <div class="col-lg-12 animated tada infinite" style="width:400px;">
            <img src="img/bell.png" style="width:60%;display:block;margin:auto; padding-top:40px;padding-left:20px;" class="animated tada infinite" alt="Get New Order" id="animated-img1">
                    
          </div>
       </div>
       <div class="col-md-12" style="width:70%;display:block;margin:auto; padding-top:70px;margin-left:110px;">
       
       <button onclick="print('<?php echo $id ?>')"  class="btn btn-md blue-gradient"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;Print
           </button>     
       <!-- <button class="btn blue-gradient"><i class="fa fa-print" aria-hidden="true"></i> Print</button> -->
       <button class="btn btn-md peach-gradient" >Cancel</button>
       </div>
      </div>
    </div>
</div>

<!-- Script inside body -->

    <!-- Audio Player -->
  <script>

    function print(id){
     var win =  window.open('print_receipt.php?id='+id+'','targetWindow','toolbar=no, location=no, status=no,menubar=no,scrollbars=no, resizable=no,width=500, height=500');
      
     // this.close();
     setTimeout(function () { win.close();}, 3000);
                                
    }
        myAudio = new Audio('<?php echo $tonePath?>'); 
        myAudio.addEventListener('ended', function() {
            this.currentTime = 0;
            this.play();
        }, false);
        myAudio.play();
  </script>




<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->


<script>

$(document).ready(function() {
    
});
</script>


<!-- JQuery -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.5/js/mdb.min.js"></script>