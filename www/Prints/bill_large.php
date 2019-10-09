<?php
// print date
$printer -> setTextSize(1, 1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> selectPrintMode(Printer::MODE_FONT_B);
$printer -> text("Date ".$date . "\n");
// $printer -> feed();

// inout time
$spaceLength = 31-(strlen($intime)+strlen($outtime)+9);
$printer -> selectPrintMode(Printer::MODE_FONT_B);
$printer -> setTextSize(2, 1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("IN: ".$intime.generateBlankSpaces($spaceLength)."OUT: ".$outtime."\n\n");
//    $printer -> text("OUT: ".$outtime."\n");
// $printer -> feed();
    
    $printer -> setTextSize(2, 2);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text("THALI AND PICKLES\n");
    $printer -> setTextSize(1, 1);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text("5-6 BALHAM STATION ROAD, BALHAM\n");
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text("SOUTH WEST LONDON, LONDON,\n");
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text("SW12 9SG.\n");
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> text("0208 673 3773\n");
    $printer -> selectPrintMode(Printer::MODE_FONT_B);
    $printer -> setJustification(Printer::JUSTIFY_CENTER);
    $printer -> setTextSize(1, 1);
    $printer -> text("www.thaliandpickles.co.uk\n");

    $printer -> feed();

    /*Product Items */
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
    $productPrice = "  £".$product->procuct_total_price;
    
    
$spaceLength = ($maxLength+4)-(strlen($productQuantiry)+strlen($productPrice));

  if(strlen($productName) > $spaceLength){
      $sub = substr($productName, 0, strpos(wordwrap($productName, $spaceLength), "\n"));
      $needSpace = $spaceLength - strlen($sub);
      $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> setTextSize(2, 1);

      $printer -> text($productQuantiry.$sub.generateBlankSpaces($needSpace));

      $printer -> selectPrintMode(Printer::MODE_FONT_A);
      $printer -> setTextSize(2, 1);
      $printer -> text(" ".$productPrice);

      $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> setTextSize(2, 1);
      $rest = str_replace($sub, "", $productName);
      $printer -> text("    ".$rest." \n");

  }else{
      
  // $printer -> text($productQuantiry."  ".$productName." \n\n");
  $needSpace = $spaceLength - strlen($productName);
  $printer -> selectPrintMode(Printer::MODE_FONT_B);
      $printer -> setTextSize(2, 1);

      $printer -> text($productQuantiry.$productName.generateBlankSpaces($needSpace));

      $printer -> selectPrintMode(Printer::MODE_FONT_A);
      $printer -> setTextSize(2, 1);
      $printer -> text(" ".$productPrice." \n");

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
   $printer -> text(generateBlankSpaces($spaceLength).$status."\n");

/* ORDER NO */
$printer -> setFont($fonts[1]);
$spaceLength = ($maxLength+9)-(strlen("PAYMENT METHOD")+strlen("  ".$orderno));
   // echo $spaceLength;
   // exit;
  $printer -> selectPrintMode(Printer::MODE_FONT_B);
   $printer -> setTextSize(2, 1);
   $printer -> setJustification(Printer::JUSTIFY_LEFT);    
   $printer -> text("ORDER NO");

  $printer -> selectPrintMode(Printer::MODE_FONT_A);
   $printer -> setJustification(Printer::JUSTIFY_LEFT);  
   $printer -> setTextSize(2, 1);
   $printer -> text(generateBlankSpaces($spaceLength).$orderno."\n");



$printer -> feed(2);

/* Footer */
$printer -> selectPrintMode(Printer::MODE_FONT_A);
$printer -> setTextSize(1, 1);
$printer -> setJustification(Printer::JUSTIFY_LEFT);
$printer -> text("Address:\n");
$printer -> text($customerAddress."\n");
$printer -> text("Mob:".$customerMobile."\n");
$printer -> text("Thank you\n\n");



/* Cut the receipt and open the cash drawer */
$printer -> cut();
$printer -> pulse();

?>