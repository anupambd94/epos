<?php 

ob_start();
include 'Resources/header_main.php';
include 'Resources/functions.php';
try{
?>

<section class="parent">
    <div class="child">
    <?php 
        

        // echo $validationYear;
        // exit;
            if(auth::CheckCirficate())
            {
                
            }else{
                echo "
                    <div class=\"alert alert-danger center\" role=\"alert\" style='font-weight:bold; padding: 10px 10px; text-align: left;'>
                       Cirtificate Trial Date Ended. Please Enter Activation code for final activation"."

                    </div>"."
                    <form action=\"sql/active.php\" method=\"post\">"."
                    <div class='container'>"."
                        <div class='row' style='width:250px;font-weight:bold; margin-left:20px; padding: 10px 10px; text-align: center;'>
                            <div class='col-sm-12'>
                            <label for='basic-url'>Activation Code</label>
                            <div class='input-group mb-3'>
                            <input type='text' name='url' value=\"$login\" class='form-control' id='basic-url'>
                            </div>
                            </div>
                        </div>
                        <br>                        
                        <div class='row'>
                            <div class=\"col-md-12\">
                                <input type=\"submit\"  class=\"fadeIn fourth\" style='width: 200px;margin-left:20px; align:center' value='Activate' name='submit'>
                            </div>                        
                        </div>
                    </div>
                    </form>
                     ";
                    
                     exit;
            }
        ?>
    </div>
</section>
<?php include 'Resources/home.php';
}
catch (Exception $e) {
    echo "Error: " . $e -> getMessage() . "\n";
    $printer -> close();
}
?>


<?php include 'Resources/footer.php';?>