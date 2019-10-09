<?php 
// include_once '..\Resources\connection.php';

class MyDB extends SQLite3 {

    function __construct(){

        $this->open('/desktopprint.db');
    }
}
$db = new MyDB();
$sql = "INSERT INTO users(name, email, password, role) VALUES ('Anupam', 'anupam.bd94@gmail.com','123456', 'Developer')";

$db->exec($sql);
?>