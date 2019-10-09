<?php
ob_start();

 include_once 'Resources/header.php';
 include_once 'Resources/functions.php';
 global $toneId, $toneName, $tonePath, $toneType;

 error_reporting(-1);
                    // include "./_pdo.php";
                    // $db_file = "./db.db";
                    // PDO_Connect("sqlite:$db_file");
                  
                    
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

<form action="sql/tonesave.php" method="post">
<div class="container" style="margin:10px; padding: 5px 10px;">
    <!-- printer setup start -->
    <h5>App Setting :</h5>
    <div class="row border-inner" >
        <div class="col-sm-8">
        <div class="input-group mb-3">
            
            <div class="input-group mb-3">
            <div class="input-group-prepend bg-local">
                <label class="input-group-text" for="inputGroupSelect01">Select Alert Tone</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01" name="tone" onchange="play()" style="margin-right:20px;">
                
                <option selected>Selected Tone: <?php echo " ".$toneName ?></option>

                <?php 
                    foreach($data as $tone){
                        // echo $tone['toneid'];
                ?>
                <option value="<?php echo $tone['toneid'] ?>" data-path="<?php echo $tone['tonepath'] ?>"><?php echo $tone['tonename'] ?></option>
                <?php 
                    }
                ?>
            </select>
            </div>
        </div>
        
    </div>
    <!-- printer setup end -->



    </div>
    <!-- Kitchen Receipt settings end -->

    <!-- Other setings start -->
    
    <br><br>
    <div class="row">
    
        <div class="col-md-4"></div>
        <div class="col-md-4 mb-3">
            <!-- <a type="button" class="form-control btn btn-primery" >Save</a> -->
            <input type="submit"  class="fadeIn fourth" style="width: 300px;margin-left:100px;" value="Save" name="submit">
        </div>
    
    </div>
<!-- Other setings end -->
</div>
</form>

<script>

    // $('#inputGroupSelect01').change(function(){
    //    var selected = $(this).find('option:selected');
    //    var selectedPath = selected.data('path'); 
    //     console.log(selectedPath);
    //    myAudio = new Audio(selectedPath); 
    //     myAudio.addEventListener('ended', function() {
    //         this.currentTime = 0;
    //         this.play();
    //     }, false);
    //     myAudio.play();
    // });
    function play(){
        var sel = document.getElementById('inputGroupSelect01');
        var selected = sel.options[sel.selectedIndex];
        var selectedPath = selected.getAttribute('data-path');

        var playing = 0;

        if(playing == 1){

            myAudio.pause();
            myAudio.currentTime = 0;

            myAudio = new Audio(selectedPath); 
            myAudio.play();

        }else{
            myAudio = new Audio(selectedPath); 
            playing = 1;
            myAudio.play();
        }

        
    }

 </script>

<?php include_once 'Resources/footer.php';?>



