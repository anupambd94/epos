<script type="text/javascript">
 function closeWindow() {
    setTimeout(function() {
    window.close();
    }, 3000);
    }

    window.onload = closeWindow();
    </script>

<?php 

if(isset($_POST['submit']))
{
$a = "";

error_reporting(-1);
include "./_pdo.php";
$db_file = "../db.db";
PDO_Connect("sqlite:$db_file");
// print("PDO_Connect(): successsfully connected<br>");
// print("The database file: <b>$db_file</b><br>");

$error = false;

// $login = $_POST['loginApi'];
// $filter = $_POST['ordersDailyApi'];
// $byid = $_POST['getOrderByIdApi'];
// $updatestatus = $_POST['updateOrderApi'];
// $new = $_POST['getNewOrdersApi'];

$url = $_POST['url'];
if($url != ""){
    $queries = "UPDATE apilist SET apilink='$url' WHERE id=9";

$queries = explode(";", $queries);
foreach ($queries as $query) {
    $query = trim($query);
    if (!$query) continue;
    $stmt = @PDO_Execute($query);
    if (!$stmt || ($stmt && $stmt->errorCode() != 0)) {
        $error = PDO_ErrorInfo();
        print_r($error[2]);
        $error = false;
        break;
    }
}

if(!$error){
    echo "updated Successfully";
}
}
else{
    echo "There some problem occures. Please try again";
}
// $queries = "UPDATE apilist SET apilink='$login' WHERE id=1".
// ";"."UPDATE apilist SET apilink='$filter' WHERE id=2".
// ";"."UPDATE apilist SET apilink='$byid' WHERE id=6".
// ";"."UPDATE apilist SET apilink='$updatestatus' WHERE id=7".
// ";"."UPDATE apilist SET apilink='$new' WHERE id=8";


// print("</pre>");

// print("<h2>Fetch data</h2>");
// print("PDO_FetchAll('SELECT * FROM user')");
// print("<pre>");
// $data = PDO_FetchAll("SELECT * FROM test");
// print_r($data);
// print("</pre>");

}


?>