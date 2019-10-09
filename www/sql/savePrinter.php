<script type="text/javascript">
 function closeWindow() {
    setTimeout(function() {
    window.close();
    }, 3000);
    }

    window.onload = closeWindow();
    </script>

    <!-- $name = $_POST['shareName'];

// echo $Name;

$queries = "UPDATE printeroptions SET fontsize=1 WHERE id=1"; -->

<?php 

if(isset($_POST['submit']))
{
$a = "";
$dishPrise = "";
error_reporting(-1);
include "./_pdo.php";
$db_file = "../db.db";
PDO_Connect("sqlite:$db_file");
// print("PDO_Connect(): successsfully connected<br>");
// print("The database file: <b>$db_file</b><br>");

// $toneId = $_POST['tone'];
$name = $_POST['shareName'];
$copies = $_POST['copies'];
global $queries;
$done = false;
$queries = "UPDATE printeroptions SET printCopies = '".$copies."' WHERE id=5".";";
if(isset($_POST['dishPrise'])){
    $dishPrise = $_POST['dishPrise'];
    if($dishPrise == 'on'){
        $dishPrise = 0;
    }
    $queries = $queries."UPDATE printeroptions SET showDishPrizeYN = '".$dishPrise."' WHERE id=5".";";

}else{
    $queries = $queries."UPDATE printeroptions SET showDishPrizeYN = 0 WHERE id=5".";";
}
if(isset($_POST['paymentMetnod'])){
    $paymentMetnod = $_POST['paymentMetnod'];
    if($paymentMetnod == 'on'){
        $paymentMetnod = 0;
    }
    $queries = $queries."UPDATE printeroptions SET showPaymentMethodYN = '".$paymentMetnod."' WHERE id=5".";";

}else{
    $queries = $queries."UPDATE printeroptions SET showDishPrizeYN = 0 WHERE id=5".";";
}
if(isset($_POST['dishFont'])){
    $dishFont = $_POST['dishFont'];
    if($dishFont == 'on'){
        $dishFont = 0;
    }
    $queries = $queries."UPDATE printeroptions SET dishFontBoldYN = '".$dishFont."' WHERE id=5".";";
}else{
    $queries = $queries."UPDATE printeroptions SET dishFontBoldYN = 0 WHERE id=5".";";    
}
if(isset($_POST['address'])){
    $address = $_POST['address'];
    if($address == 'on'){
        $address = 0;
    }
    $queries = $queries."UPDATE printeroptions SET showAddressYN = '".$address."' WHERE id=5".";";

}else{
    $queries = $queries."UPDATE printeroptions SET showAddressYN = 0 WHERE id=5".";";    
}
if(isset($_POST['amount'])){
    $amount = $_POST['amount'];
    if($amount == 'on'){
        $amount = 0;
    }
    $queries = $queries."UPDATE printeroptions SET showTotalAmountYN = '".$amount."' WHERE id=5".";";

}else{
    $queries = $queries."UPDATE printeroptions SET showTotalAmountYN = 0 WHERE id=5".";";    
}
if(isset($_POST['RAddress'])){
    $RAddress = $_POST['RAddress'];
    if($RAddress == 'on'){
        $RAddress = 0;
    }
    $queries = $queries."UPDATE printeroptions SET showRAddressYN = '".$RAddress."' WHERE id=5".";";
}else{
    $queries = $queries."UPDATE printeroptions SET showRAddressYN = 0 WHERE id=5".";";
    
}

$queries .= "UPDATE printeroptions SET shareName='".$name."' WHERE id=5";
// echo $dishPrise;
// exit;
// echo $Name;
// echo $queries;


$queries = explode(";", $queries);
foreach ($queries as $query) {
    $query = trim($query);
    if (!$query) continue;
    $stmt = @PDO_Execute($query);
    if (!$stmt || ($stmt && $stmt->errorCode() != 0)) {
        $error = PDO_ErrorInfo();
        print_r($error[2]);
        break;
    }else{
        $done = true;
    }
}

if($done){
    echo "Updated Successfully";

}

}


?>