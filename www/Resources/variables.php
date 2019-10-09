<?php
ob_start();

 global $login, $filter, $updateStatus, $newOrders,$orderById,$url;
 $validationDate = date('m');
 $validationYear = date('y');
 error_reporting(-1);
                    include "./_pdo.php";
                    $db_file = "./db.db";
                    PDO_Connect("sqlite:$db_file");
                  
                    $apilist = PDO_FetchAll("SELECT * FROM apilist");
                    foreach($apilist as $api){
                    //   $toneDetails = PDO_FetchAll("SELECT * FROM ringtonelist WHERE toneid=".$tone['toneid']);
                    if($api['apiname'] == "login"){
                    $login = $api['apilink'];

                    }
                    if($api['apiname'] == "filter"){
                        $filter = $api['apilink'];
    
                    }
                    if($api['apiname'] == "byid"){
                        $orderById = $api['apilink'];
    
                    }
                    if($api['apiname'] == "updatestatus"){
                        $updateStatus = $api['apilink'];
    
                    }
                    if($api['apiname'] == "new"){
                        $newOrders = $api['apilink'];
    
                    }
                    if($api['apiname'] == "url"){
                        $url = $api['apilink'];
    
                    }
                    }
                   
?>