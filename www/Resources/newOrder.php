<?php
try{
    
    $connceted = auth::is_connected();
    // $orderOject = new orderList;
    // echo $url.$newOrders;
    // exit;
    if($connceted){

        $content = file_get_contents($url.$newOrders);

        if($content){
            // $content = file_get_contents($link);
            $list = json_decode($content);
                foreach($list->orders as $allOrders){
                        $newOrderStatus = $allOrders->order->order_status;
                        // echo $newOrderTime."<br>";
                        if($newOrderStatus  == "0"){
                            // array_push($orderTimeList,$allOrders->order->order_time);
                            $orderId =  $allOrders->order->order_id;
                            // echo $orderId;
                            echo "<script>",
                            "window.open('ringbell.php?id=$orderId','targetWindow',",
                            "'toolbar=no, location=no, status=no,menubar=no,scrollbars=no, resizable=no,width=500, height=500');",
                                "</script>"
                            ;
                        }
                    }
       }else{
           echo "Please Check The Resturent Url";
       }
    }else{
        echo "<div class=\"animated pulse infinite slower delay-5s\"><span  style=\"color:red;margin:30px;font-size:16px;font-weight:bold;\">Internet Connection Faild!</span></div>";
    }
    
}
catch (Exception $e) {
    echo "Server Error: "."<br>"."Error: " . $e -> getMessage(). "\n <br>";
}

    


?>