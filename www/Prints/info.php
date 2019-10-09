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

?>