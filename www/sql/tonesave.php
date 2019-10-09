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

$toneId = $_POST['tone'];

$queries = "UPDATE activetone SET toneid=".$toneId." WHERE id=1";

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
        echo "Updated Successfully";
    }
}
// print("</pre>");

// print("<h2>Fetch data</h2>");
// print("PDO_FetchAll('SELECT * FROM user')");
// print("<pre>");
// $data = PDO_FetchAll("SELECT * FROM test");
// print_r($data);
// print("</pre>");

}


?>