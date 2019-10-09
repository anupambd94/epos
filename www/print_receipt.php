
<script type="text/javascript">
 function closeWindow() {
    setTimeout(function() {
    window.close();
    }, 3000);
    }

    window.onload = closeWindow();
</script>
<?php
        include_once 'Resources/variables.php';

global $shareName,$copies, $toneName, $tonePath, $toneType;
error_reporting(-1);
global $login, $filter, $updateStatus, $newOrders,$orderById,$url;

 error_reporting(-1);
                    
                
                    $previousOptions = PDO_FetchAll("SELECT * FROM printeroptions");
                    
                    foreach($previousOptions as $printer){
                      $shareName = $printer['shareName'];
                      $copies = $printer['printCopies'];
                      $showDishPrize = $printer['showDishPrizeYN'];
                        $showPaymentMethod = $printer['showPaymentMethodYN'];
                        $showAddress = $printer['showAddressYN'];
                        $showTotalAmount = $printer['showTotalAmountYN'];
                        $showRAddress = $printer['showRAddressYN'];
                        $dishFondBold = $printer['dishFontBoldYN'];
                    }
// echo $shareName;
// exit;
/* Change to the correct path if you copy this example! */
// Add item in array
    // array_push($a,"blue","yellow");
// for Uro Character
// echo "\xE2\x82\xAc";


require __DIR__ . '/vendor/mike42/escpos-php/autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
global $id;
$id  = $_REQUEST['id'];
    echo "PRINTING RECEIPT FOR ORDER ID: ".$id."<br>";
    // exit;
    function updatePrintStatus($orderId){
        global $login, $filter, $updateStatus, $newOrders,$orderById,$url;
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

                $curl = curl_init();
                $auth_data = array(
                    'order_id' 	=> $orderId,
                    'status' 	=> 1
                );
      
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
                // curl_setopt($curl, CURLOPT_URL, 'http://mukith.site/ooapi/adminlogin');
                curl_setopt($curl, CURLOPT_URL, $url.$updateStatus);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      
                $content = curl_exec($curl);
                if(!$content){die("Connection Failure");}
      
                $result = json_decode($content);
      
                // if($result->status == 1){
                //     echo "Printing New Order";
                // }else{
                //   echo "Status Not Updated";
                // }
                curl_close($curl);
      }

   

    // Enter the share name for your USB printer here
    // $connector = null;
    function getAllContents(){
        global $login, $filter, $updateStatus, $newOrders,$orderById,$url;

 
                   
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

        $id = $_REQUEST['id'];
        // echo $id;
         // get elements from API
         $link = $url.$orderById.$id;
         $content =  file_get_contents($link);
         
         $result  = json_decode($content);
            // var_dump($result);
            // exit;
         return $result;
    }

    function getSiteInformations(){
        global $url;

 
                   
        $apilist = PDO_FetchAll("SELECT * FROM apilist");
        foreach($apilist as $api){
        //   $toneDetails = PDO_FetchAll("SELECT * FROM ringtonelist WHERE toneid=".$tone['toneid']);
       
        if($api['apiname'] == "url"){
            $url = $api['apilink'];

        }
        }
        $content =  file_get_contents($url."ooapi/restaurant_info");
         
         $result  = json_decode($content);
            // var_dump($result);
            // exit;
         return $result;
    }

    function generateBlankSpaces($num){
        $result = "";
        $i = 0;
        for($i = 0; $i<$num; $i++){
            $result .= " ";
        }
    
        return $result;
    }
    
    try {
        // Enter the share name for your USB printer here
        // $connector = null;
         $orderElements = getAllContents();
         $siteInfo = getSiteInformations();
         global $maxLength,$SiteName,$postCode, $mobile,$address,$siteUrl;
    // for Uro Character
        
        // Initiallizations
        $totalitem = 0;
        $orderno = "";
        $ordertype = "";
        $customertype = "NEW CUSTOMER";
        $kitchenitems = array();
        $productitems = array();
        $customerAddress = "";
        $customerMobile = "";
        $date = "Monday 6th of April 2015 02:56:25 PM";
        $intime = "0";
        $outtime = "0";
        $connector = "";
        $sharerName = "EPSON TM-T20II Receipt5";
        $maxLength = 24;
        $siteName = $siteInfo->info->name;
        $address = $siteInfo->info->address;
        $postCode = $siteInfo->info->post_code;
        $phone = $siteInfo->info->phone;
        $siteUrl = $siteInfo->info->site_url;

        foreach($orderElements->order->products as $product){
            $productQuantiry = $product->product_quantity."X";
            $productName = $product->product_name;
            $productPrice = $product->procuct_total_price;
    
            $productitemString =  new productitem($productQuantiry, $productName, $productPrice);
            $kitchenitemString =  new kichenitem($productQuantiry, $productName);
    
            array_push($productitems,$productitemString);
            array_push($kitchenitems,$kitchenitemString);
    
            // $productQuantiry = $product->product_quantity."X";
            // $productName = $product->product_name;
            // $productPrice = "£ ".$product->procuct_total_price;
    
            // echo $productQuantiry." Item Name   ".$productPrice."\n";
    
    
            $totalitem++;
        }
    
        // $date = date('l jS \of F Y h:i:s A');
        $date = date('d/F/Y');
        $orderno = $orderElements->order->order->order_id;
        $ordertype  = $orderElements->order->order->order_type;
    
        
        // $in = $orderElements->order->order->intime;
        // $dtin = new DateTime("@$in",new DateTimezone('Europe/London'));  // convert UNIX timestamp to PHP DateTime
        // $intime =  $dtin->format('g:i A');
        $intime =  $orderElements->order->order->intime;

        // $out = $orderElements->order->order->outtime;
        // $dtout = new DateTime("@$out",new DateTimezone('Europe/London'));  // convert UNIX timestamp to PHP DateTime
        // $outtime =  $dtout->format('g:i A');
        $outtime =  $orderElements->order->order->outtime;
        
        // just for test.. Have to add original intime and out time latesr
        // $intime = date("g:i A",strtotime($orderElements->order->order->intime));
        // $outtime = date("g:i A",strtotime($orderElements->order->order->outtime));
       
        // $inouttime = "IN: ".$intime." "."OUT: ".$outtime;
       
        $customerAddress = $orderElements->order->order->customer_address;
        $customerPostCode = $orderElements->order->order->customer_postcode;
        $customerEmail = $orderElements->order->order->customer_email;
        $customerName = $orderElements->order->order->customer_name;
        $customerMobile = $orderElements->order->order->customer_phone;
        $customertype = $orderElements->order->order->customer_type;
        $totalItemString = new kichenitem("Item Total", $totalitem);
        $orderTypeString = new kichenitem("Order Type", $ordertype);
        $orderIdString = new kichenitem("Order No", $orderno);

        
            // * Start the printer and print for Customer*/
    // Inital Variables
    $OrderTotal = "";
    $discount = "";
    $discountAmount = "";
    $cardChargeAmount = "";
    $deliveryChargeAmount = "";
    $grandTotalAmount  = "";
    $charge = "";
    $grandTotal = "";
    $paymentMethod = "";
    $paymentStatus = "";
    $TotalOrderAmount = "£".$orderElements->order->order->sub_total;
    $OrderTotal = new productitemforbill("", 'ORDER TOTAL', $TotalOrderAmount);

    // discout Emplementation
    $discount = $orderElements->order->order->discount;
    $haveDiscount = false;
    $discountPercentage = 0;
    $spaceLength = 0;

    if($discount > 0){
        $haveDiscount = true;
        $amount = $orderElements->order->order->sub_total;
        $discountAmount = "-£".$discount;

        $discountPercentage = ($discount/$amount)*100;
        $discountPercentage = number_format((float)$discountPercentage, 0, '.', '');
        $discount = new productitemforbill('', $discountPercentage."% DISCOUNT", $discount."\n");
    }
    
    // charge discout Emplementation
    $cardcharge = $orderElements->order->order->card_charge;
    $deliverycharge = $orderElements->order->order->delivery_charge;
    $haveCardCharge = false;
    $haveDeliveryCharge = false;

    if($cardcharge > 0){
        $haveCardCharge = true;
        $charge = new productitemforbill("", 'Card Charge', $cardcharge."\n");
        $cardChargeAmount = "+£".$cardcharge;
    }
    if($deliverycharge > 0){
        $haveDeliveryCharge = true;
        $charge = new productitemforbill("", 'Delivery Charge', $deliverycharge."\n");
        $deliveryChargeAmount = "+£".$deliverycharge;

    }

    $grandTotalAmount  = "£".$orderElements->order->order->total_amount;
    $grandTotal = new productitemforbill("", 'GRAND TOTAL', $grandTotalAmount);
    $method = $orderElements->order->order->payment_method;
    $paymentMethod = new kichenitemforbill("Payment Method", $method);

    $status = "NOT PAID";
    if($orderElements->order->order->payment_status == '1'){
        $status = "PAID";
    }
    $paymentStatus = new kichenitemforbill("Payment Status", $status);
    
    /* Start the printer and print for kitchen*/

    $connector = new WindowsPrintConnector($shareName);
    $printer = new Printer($connector);
    
    // common setups
    /* Fonts (many printers do not have a 'Font C') */
    $fonts = array(
        Printer::FONT_A,
        Printer::FONT_B,
        Printer::FONT_C);


        for($i=0; $i < $copies; $i++){
            // ______________________________________________________________________________________
        // KITCHEN RECEIPT
        // ______________________________________________________________________________________
        $printer -> setTextSize(2, 2);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("KITCHEN\n");
        // print date
        $printer -> setTextSize(1, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> text("Date ".$date . "\n");
        // $printer -> feed();

        // inout time
        $spaceLength = 31-(strlen($intime)+strlen($outtime)+9);
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 2);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> text("IN: ".$intime.generateBlankSpaces($spaceLength)."OUT: ".$outtime."\n\n");
        //    $printer -> text("OUT: ".$outtime."\n");
        // $printer -> feed();
        // $printer -> cut();
        // $printer -> pulse();

        //         /* Close printer */
        //         $printer -> close();
        // exit;

        $printer -> setTextSize(2, 2);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text($siteName."\n\n");

        if($showRAddress==1 || $ordertype == "Delivery"){
            $printer -> setTextSize(1, 1);
            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> text(generateBlankSpaces(5).$address.generateBlankSpaces(5)."\n");
            // $printer -> setJustification(Printer::JUSTIFY_CENTER);
            // $printer -> text("SOUTH WEST LONDON, LONDON,\n");
            // $printer -> setJustification(Printer::JUSTIFY_CENTER);
            // $printer -> text("SW12 9SG.\n");
            // $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> text($phone."\n");
            $printer -> text("VAT NO: 243223442\n");
            $printer -> selectPrintMode(Printer::MODE_FONT_B);
            $printer -> setJustification(Printer::JUSTIFY_CENTER);
            $printer -> setTextSize(1, 1);
            $printer -> text($siteUrl."\n");
        }
        

        $printer -> feed();

        /*Kitchen Items */
        $printer -> setJustification(Printer::JUSTIFY_LEFT);

        $printer -> setTextSize(2, 2);
        foreach ($orderElements->order->products as $product) {
            // Just have to maintain the productname
            $productQuantiry = $product->product_quantity."X ";
            $productName = $product->product_name;

        // $printer -> text($productQuantiry." Item Name  ".$productPrice." \n");
        // if($product->procuct_total_price < 10){
        //     $productPrice = "   £  ".$product->procuct_total_price."";


        // }else{
        //     $productPrice = "   £ ".$product->procuct_total_price."";

        // }
        $productPrice = "  £".$product->procuct_total_price."";


        $spaceLength = ($maxLength+4)-(strlen($productQuantiry)+strlen($productPrice));

        if(strlen($productName) > $spaceLength){
        $sub = substr($productName, 0, strpos(wordwrap($productName, $spaceLength), "\n"));
        $needSpace = $spaceLength - strlen($sub);
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 2);

        $printer -> text($productQuantiry.$sub.generateBlankSpaces($needSpace));

        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setTextSize(2, 2);
        $printer -> text($productPrice." \n");

        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 2);
        $rest = str_replace($sub, "", $productName);
        $printer -> text("   ".$rest." \n\n");

        }else{
        
        // $printer -> text($productQuantiry."  ".$productName." \n\n");
        $needSpace = $spaceLength - strlen($productName);
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 2);

        $printer -> text($productQuantiry.$productName.generateBlankSpaces($needSpace));

        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setTextSize(2, 2);
        $printer -> text($productPrice." \n\n");

        //    $printer -> text($productQuantiry.$productName.generateBlankSpaces($needSpace).$productPrice." \n\n");
        }
        }
        $printer -> feed();

        if($showTotalAmount == 1){
            // Order TOTAL
            $printer -> setTextSize(2, 1);
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            // $printer -> text($totalItemString."\n");
            $spaceLength = ($maxLength+5)-(strlen("ORDER TOTAL")+strlen("  ".$TotalOrderAmount));
            // $printer -> text("ORDER TOTAL".generateBlankSpaces($spaceLength).$TotalOrderAmount."\n");
            $printer -> selectPrintMode(Printer::MODE_FONT_B);
            $printer -> setTextSize(2, 1);

            $printer -> text("ORDER TOTAL".generateBlankSpaces($spaceLength));

            $printer -> selectPrintMode(Printer::MODE_FONT_A);
            $printer -> setTextSize(2, 1);
            $printer -> text("  ".$TotalOrderAmount." \n");


            // Discount 
            if($haveDiscount){
            $printer -> setTextSize(2, 1);
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            // $printer -> text($totalItemString."\n");
            $spaceLength = ($maxLength+2)-(strlen("DISCOUNT")+strlen("  ".$discountAmount));
            $printer -> text("DISCOUNT".generateBlankSpaces($spaceLength).$discountAmount."\n");

            }


            // Charges
            if($haveCardCharge){
            $printer -> setTextSize(2, 1);
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            // $printer -> text($totalItemString."\n");
            $spaceLength = ($maxLength+2)-(strlen("CARD CHARGE")+strlen("  ".$cardChargeAmount));
            $printer -> text("CARD CHARGE".generateBlankSpaces($spaceLength).$cardChargeAmount."\n");

            }
            if($haveDeliveryCharge){
            $printer -> setTextSize(2, 1);
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            // $printer -> text($totalItemString."\n");
            $spaceLength = ($maxLength+2)-(strlen("DELIVERY CHARGE")+strlen("  ".$deliveryChargeAmount));
            $printer -> text("DELIVERY CHARGE".generateBlankSpaces($spaceLength).$deliveryChargeAmount."\n");

            }

            // ?Grand Total
            $printer -> setTextSize(2, 1);
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            // $printer -> text($totalItemString."\n");
            $spaceLength = ($maxLength+2)-(strlen("GRAND TOTAL")+strlen("  ".$grandTotalAmount));
            $printer -> text("GRAND TOTAL".generateBlankSpaces($spaceLength).$grandTotalAmount."\n\n");

        }
        

        // ITEM TOTAL
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        // $printer -> text($totalItemString."\n");
        $spaceLength = $maxLength-(strlen("Item Total")+strlen("  ".$totalitem));
        $printer -> text("ITEM TOTAL".generateBlankSpaces($spaceLength).$totalitem."\n\n");


        // ORDER TYPE
        $printer -> setFont($fonts[1]);
        $spaceLength = ($maxLength+6)-(strlen("ORDER TYPE")+strlen("  ".$ordertype));
        // echo $spaceLength;
        // exit;
        $printer -> setTextSize(1, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);    
        $printer -> text("ORDER TYPE");
        $printer -> setJustification(Printer::JUSTIFY_LEFT);  
        $printer -> setTextSize(3, 2);
        $printer -> text(generateBlankSpaces($spaceLength).$ordertype."\n\n");

        // Payment method type
        $printer -> setFont($fonts[1]);
        $spaceLength = ($maxLength+5)-(strlen("PAYMENT METHOD")+strlen("  ".$method));
        // echo $spaceLength;
        // exit;
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);    
        $printer -> text("PAYMENT METHOD");

        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);  
        $printer -> setTextSize(2, 1);
        $printer -> text(generateBlankSpaces($spaceLength).$method."\n");


        if($showPaymentMethod == 1){
            // Paymant Stuatus Paid or not paid
            $printer -> setFont($fonts[1]);
            $spaceLength = ($maxLength+5)-(strlen("PAYMENT METHOD")+strlen("  ".$status));
            // echo $spaceLength;
            // exit;
            $printer -> selectPrintMode(Printer::MODE_FONT_B);
            $printer -> setTextSize(2, 1);
            $printer -> setJustification(Printer::JUSTIFY_LEFT);    
            $printer -> text("PAYMENT STATUS");

            $printer -> selectPrintMode(Printer::MODE_FONT_A);
            $printer -> setJustification(Printer::JUSTIFY_LEFT);  
            $printer -> setTextSize(2, 1);
            $printer -> text(generateBlankSpaces($spaceLength).$status."\n\n");
        }
        

        /* ORDER NO */
        $printer -> setFont($fonts[1]);
        $spaceLength = ($maxLength)-(strlen("ORDER NO")+strlen($orderno));

        $printer -> setTextSize(2, 1);    
        $printer -> setJustification(Printer::JUSTIFY_LEFT);    
        $printer -> text("ORDER NO");
        $printer -> setTextSize(3, 3);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);    
        $printer -> text(generateBlankSpaces($spaceLength).$orderno."\n");

        $printer -> feed(2);

        /* Footer */
        if($showAddress == 1){
            $printer -> selectPrintMode(Printer::MODE_FONT_B);
            $printer -> setTextSize(2, 1);
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            $printer -> text($customerName."\n");
            $printer -> text("Address:\n");
            $printer -> text($customerAddress."\n");
            $printer -> text($customerPostCode."\n");
            $printer -> text("Mob: ".$customerMobile."\n");
            $printer -> text("Email: ".$customerEmail."\n");

        }else{
            $printer -> selectPrintMode(Printer::MODE_FONT_B);
            $printer -> setTextSize(2, 1);
            $printer -> setJustification(Printer::JUSTIFY_LEFT);
            $printer -> text("Address:\n");
            $printer -> text($customerName."\n");
            $printer -> text("Mob:".$customerMobile."\n");
            $printer -> text("Email: ".$customerEmail."\n");
        }
        


        $printer -> text("Thank you\n\n");
        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text($customertype."\n");


            
        /* Cut the receipt and open the cash drawer */
        $printer -> cut();
        $printer -> pulse();

        // ______________________________________________________________________________________
            // BILL RECEIPT
        // ______________________________________________________________________________________

        // print date
        $printer -> setTextSize(1, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> text("Date ".$date . "\n");
        // $printer -> feed();

        // inout time
        $spaceLength = 31-(strlen($intime)+strlen($outtime)+9);
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 2);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> text("IN: ".$intime.generateBlankSpaces($spaceLength)."OUT: ".$outtime."\n\n");
        //    $printer -> text("OUT: ".$outtime."\n");
        // $printer -> feed();

        $printer -> setTextSize(2, 2);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text($siteName."\n\n");
        $printer -> setTextSize(1, 1);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text(generateBlankSpaces(5).$address.generateBlankSpaces(5)."\n");
        // $printer -> setJustification(Printer::JUSTIFY_CENTER);
        // $printer -> text("SOUTH WEST LONDON, LONDON,\n");
        // $printer -> setJustification(Printer::JUSTIFY_CENTER);
        // $printer -> text("SW12 9SG.\n");
        // $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text($phone."\n");
        $printer -> text("VAT NO: 243223442\n");
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> setTextSize(1, 1);
        $printer -> text($siteUrl."\n");
        $printer -> feed();

        /*Kitchen Items */
        $printer -> setJustification(Printer::JUSTIFY_LEFT);

        $printer -> setTextSize(2, 1);
        foreach ($orderElements->order->products as $product) {
            // Just have to maintain the productname
            $productQuantiry = $product->product_quantity."X ";
            $productName = $product->product_name;

        // $printer -> text($productQuantiry." Item Name  ".$productPrice." \n");
        // if($product->procuct_total_price < 10){
        //     $productPrice = "   £  ".$product->procuct_total_price."";


        // }else{
        //     $productPrice = "   £ ".$product->procuct_total_price."";

        // }
        $productPrice = "  £".$product->procuct_total_price."";


        $spaceLength = ($maxLength+4)-(strlen($productQuantiry)+strlen($productPrice));

        if(strlen($productName) > $spaceLength){
        $sub = substr($productName, 0, strpos(wordwrap($productName, $spaceLength), "\n"));
        $needSpace = $spaceLength - strlen($sub);
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 1);

        $printer -> text($productQuantiry.$sub.generateBlankSpaces($needSpace));

        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setTextSize(2, 1);
        $printer -> text($productPrice." \n");

        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 1);
        $rest = str_replace($sub, "", $productName);
        $printer -> text("   ".$rest." \n");

        }else{
        
        // $printer -> text($productQuantiry."  ".$productName." \n\n");
        $needSpace = $spaceLength - strlen($productName);
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 1);

        $printer -> text($productQuantiry.$productName.generateBlankSpaces($needSpace));

        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setTextSize(2, 1);
        $printer -> text($productPrice." \n");

        //    $printer -> text($productQuantiry.$productName.generateBlankSpaces($needSpace).$productPrice." \n\n");
        }
        }
        $printer -> feed();


        // Order TOTAL
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        // $printer -> text($totalItemString."\n");
        $spaceLength = ($maxLength+5)-(strlen("ORDER TOTAL")+strlen("  ".$TotalOrderAmount));
        // $printer -> text("ORDER TOTAL".generateBlankSpaces($spaceLength).$TotalOrderAmount."\n");
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 1);

        $printer -> text("ORDER TOTAL".generateBlankSpaces($spaceLength));

        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setTextSize(2, 1);
        $printer -> text("  ".$TotalOrderAmount." \n");


        // Discount 
        if($haveDiscount){
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        // $printer -> text($totalItemString."\n");
        $spaceLength = ($maxLength+2)-(strlen("DISCOUNT")+strlen("  ".$discountAmount));
        $printer -> text("DISCOUNT".generateBlankSpaces($spaceLength).$discountAmount."\n");

        }


        // Charges
        if($haveCardCharge){
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        // $printer -> text($totalItemString."\n");
        $spaceLength = ($maxLength+2)-(strlen("CARD CHARGE")+strlen("  ".$cardChargeAmount));
        $printer -> text("CARD CHARGE".generateBlankSpaces($spaceLength).$cardChargeAmount."\n");

        }
        if($haveDeliveryCharge){
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        // $printer -> text($totalItemString."\n");
        $spaceLength = ($maxLength+2)-(strlen("DELIVERY CHARGE")+strlen("  ".$deliveryChargeAmount));
        $printer -> text("DELIVERY CHARGE".generateBlankSpaces($spaceLength).$deliveryChargeAmount."\n");

        }

        // ?Grand Total
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        // $printer -> text($totalItemString."\n");
        $spaceLength = ($maxLength+2)-(strlen("GRAND TOTAL")+strlen("  ".$grandTotalAmount));
        $printer -> text("GRAND TOTAL".generateBlankSpaces($spaceLength).$grandTotalAmount."\n\n");

        // ITEM TOTAL
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        // $printer -> text($totalItemString."\n");
        $spaceLength = $maxLength-(strlen("ITEM TOTAL")+strlen("  ".$totalitem));
        $printer -> text("ITEM TOTAL".generateBlankSpaces($spaceLength).$totalitem."\n\n");

        // ORDER TYPE
        $printer -> setFont($fonts[1]);
        $spaceLength = ($maxLength+6)-(strlen("ORDER TYPE")+strlen("  ".$ordertype));
        // echo $spaceLength;
        // exit;
        $printer -> setTextSize(1, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);    
        $printer -> text("ORDER TYPE");
        $printer -> setJustification(Printer::JUSTIFY_LEFT);  
        $printer -> setTextSize(3, 2);
        $printer -> text(generateBlankSpaces($spaceLength).$ordertype."\n\n");



        // Payment method type
        $printer -> setFont($fonts[1]);
        $spaceLength = ($maxLength+5)-(strlen("PAYMENT METHOD")+strlen("  ".$method));
        // echo $spaceLength;
        // exit;
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);    
        $printer -> text("PAYMENT METHOD");

        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);  
        $printer -> setTextSize(2, 1);
        $printer -> text(generateBlankSpaces($spaceLength).$method."\n");



        // Paymant Stuatus Paid or not paid
        $printer -> setFont($fonts[1]);
        $spaceLength = ($maxLength+5)-(strlen("PAYMENT METHOD")+strlen("  ".$status));
        // echo $spaceLength;
        // exit;
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);    
        $printer -> text("PAYMENT STATUS");

        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);  
        $printer -> setTextSize(2, 1);
        $printer -> text(generateBlankSpaces($spaceLength).$status."\n\n");

        /* ORDER NO */
        $printer -> setFont($fonts[1]);
        $spaceLength = ($maxLength)-(strlen("ORDER NO")+strlen($orderno));

        $printer -> setTextSize(2, 1);    
        $printer -> setJustification(Printer::JUSTIFY_LEFT);    
        $printer -> text("ORDER NO");
        $printer -> setTextSize(3, 3);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);    
        $printer -> text(generateBlankSpaces($spaceLength).$orderno."\n");



        $printer -> feed(2);

        /* Footer */
        $printer -> selectPrintMode(Printer::MODE_FONT_B);
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $printer -> text($customerName."\n");
        $printer -> text("Address:\n");
        $printer -> text($customerAddress."\n");
        $printer -> text($customerPostCode."\n");
        $printer -> text("Mob: ".$customerMobile."\n");
        $printer -> text("Email: ".$customerEmail."\n");
        $printer -> text("Thank you\n\n");
        $printer -> selectPrintMode(Printer::MODE_FONT_A);
        $printer -> setTextSize(2, 1);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text($customertype."\n");


        /* Cut the receipt and open the cash drawer */


        $printer -> cut();
        $printer -> pulse();
        }//end of for loop for copies

        /* Close printer */
        $printer -> close();

    updatePrintStatus($id);
    // header('location: index.php');

} catch (Exception $e) {
    echo "Couldn't print to this printer: "."<br>"."Error: " . $e -> getMessage() . "\n";
    $printer -> close();
}

class kichenitem
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 28;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}
class kichenitemforbill
{
    private $name;
    private $price;
    private $dollarSign;

    public function __construct($name = '', $price = '', $dollarSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> dollarSign = $dollarSign;
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 22;
        if ($this -> dollarSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> dollarSign ? '$ ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}

class productitem
{
    private $name;
    private $quantiry;
    private $price;
    private $uro;

    public function __construct($quantiry = '', $name = '', $price = '')
    {
        $this -> name = $name;
        $this -> quantiry = $quantiry;
        $this -> price = $price;
        $this -> uro = '£';
    }

    public function __toString()
    {
        $rightCols = 1;
        $leftCols = 30-(strlen($this -> quantiry)+strlen($this -> price)+2);
        $sign = $this->uro;
        

        $left = str_pad($this -> quantiry . $this -> name, $leftCols) ;
        $right = str_pad($sign .' '. $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}

class productitemforbill
{
    private $name;
    private $quantiry;
    private $price;
    private $uro;

    public function __construct($quantiry = '', $name = '', $price = '')
    {
        $this -> name = $name;
        $this -> quantiry = $quantiry;
        $this -> price = '£'.$price;
    }

    public function __toString()
    {
        
        $leftCols = 32-(strlen($this -> name)+strlen($this -> price));
        // echo "name: ".$this -> name."<br>";
        // echo "price: ".$this -> price."<br>";

        // echo "spaces: ".$leftCols."<br>";

        $result = $this->name.generateBlankSpaces($leftCols).$this->price;
        // echo "rasult: ".$result."<br>";

       

        // $left = str_pad($this -> quantiry . $this -> name, $leftCols) ;
        // $right = str_pad($sign .' '. $this -> price, $rightCols, ' ', STR_PAD_LEFT);
        return "$result\n";
    }
}

?>



<?php 
include 'Resources/footer.php';
?>