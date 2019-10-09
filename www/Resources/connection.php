<?php 

class MyDB extends SQLite3 {

    function __construct(){

        $this->open('\desktopprint.db');
    }
}

$db = new MyDB();
?>