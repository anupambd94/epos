<?php


$content =     file_get_contents("http://mukith.site/ooapi/new_orders");

$result  = json_decode($content);

foreach($result as $a){

print_r($a); 
echo "<br>";
}

?>