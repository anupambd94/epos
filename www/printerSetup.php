<?php
ob_start();
global $shareName, $toneName, $tonePath, $toneType;
error_reporting(-1);
                    // include "./_pdo.php";
                    // $db_file = "./db.db";
                    // PDO_Connect("sqlite:$db_file");
                  
                    
                   
 include_once 'Resources/header.php';
 include_once 'Resources/functions.php';

 $previousOptions = PDO_FetchAll("SELECT * FROM printeroptions");
                    
 foreach($previousOptions as $printer){
   $shareName = $printer['shareName'];
   $printerCopies = $printer['printCopies'];
   $showDishPrize = $printer['showDishPrizeYN'];
   $showPaymentMethod = $printer['showPaymentMethodYN'];
   $showAddress = $printer['showAddressYN'];
   $showTotalAmount = $printer['showTotalAmountYN'];
   $showRAddress = $printer['showRAddressYN'];
   $dishFondBold = $printer['dishFontBoldYN'];
 }
?>

<form action="sql/savePrinter.php" method="post">

<?php include_once 'Resources/setupBody.php';?>

</form>



<?php include_once 'Resources/footer.php';?>


<script>
//     $(document).ready(function() {
//     //set initial state.
//     $('#dishPrise').val(this.checked);

//     $('#dishPrise').change(function() {
//         if(this.checked) {
//             var returnVal = confirm("Are you sure?");
//             $(this).prop("checked", returnVal);
//         }
//         $('#dishPrise').val(this.checked);  

//         console.log($('#dishPrise').val());      
//     });
// });   

$(document).ready(function () {
        $("input:checkbox").on('change',function(){
            var $this = $(this);

            if($this.is(":checked")){
                var Id = $this.attr("id");
                $this.val("1");
                console.log(Id + " => "+ $this.val());
            }else{

                var Id = $this.attr("id");
                $this.val("0");
                console.log(Id + " => "+ $this.val());               
            }
        });
    });
        
</script>
