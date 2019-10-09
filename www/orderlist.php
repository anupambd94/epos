<?php 
    include 'Resources/functions.php';
    include 'Resources/header.php';
 
    $rangeDate =  "";
    $selectedOption = $url.$filter."today";
    // echo 'Initial value selectedOption::' . $selectedOption;
    if (isset($_POST['selectedOption'])) {
        $rangeDate =  "";
        $selectedOption = $_POST['selectedOption'];
    }

    if(isset($_POST['endDate'])){
        if($_POST['startDate'] != ""){
            $selectedOption = "";
            $selectedStartDate = strtotime($_POST['startDate']);
            $selectedEndDate = strtotime($_POST['endDate']);
            $rangeDate = $url.$filter . date('Y-m-d',$selectedStartDate).','.date('Y-m-d',$selectedEndDate);
        }else{
            // echo '<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>';
            echo '<script language="javascript">';
            echo 'alert("Pleaes Select Start Date")';
            echo '</script>';
        }
    }

    if($selectedOption != ""){
        $orderOject = new orderList($selectedOption);
    }
    if($rangeDate != ""){
        $orderOject = new orderList($rangeDate);
    }

    if($selectedOption == "" && $rangeDate == ""){
        $orderOject = new orderList();
    }
    
    // echo "selcected Option: ".$selectedOption;
    // echo "&nbsp";
    // echo "Date Range: ".$rangeDate;

    // $orderOject = new orderList();

?>
   <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    
<!-- Font Awesome -->


<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="#">
  <?php 
        echo "THAI AND PICKLIES (".$orderOject->getTodaysOrderCount().") ";
    ?>
    </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li> -->
      <li class="nav-item dropdown active">
            <form name="myform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <select name="selectedOption" class="form-control" id="selectedOption" onchange="myform.submit();">
                    <option value="" disabled selected>Choose Filter Option</option>
                    <option value="<?php echo $url.$filter."today"; ?>">Daily</option>
                    <option value="<?php echo $url.$filter."weekly"; ?>">Weekly</option>
                    <option value="<?php echo $url.$filter."monthly"; ?>">Monthly</option>
              
                </select>
        </form>
      
      </li>
      <li class="nav-item listBorder" id="dateRangeName">
                <a class="nav-link">Filer by Date Range: </a>
      </li> 
      <li class="nav-item" id="dateRange">
      <form name="myDateRangeform" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >

            <div class="input-group input-daterange">
                <input name="startDate" type="text" id="datepicker" class="form-control"  placeholder="Select Start Date">
                <div class="input-group-addon">&nbsp; <b>to</b> &nbsp; </div>
                <input name="endDate" onchange="myDateRangeform.submit();" type="text" class="form-control"  placeholder="Select End Date">
            </div>
      </form>
      </li>
    </ul>
  </div>
</nav>
<?php
// testing section
// $orderOject->setProperty();
// $orderProperty = new OrderProperties;

// $orderProperty->orderCount = 5;

// echo $orderOject->getTodaysOrderCount();
// echo $orderProperty->TodaysOrderCount;
// exit;
?>
<div id="container">

<div id="page-wrapper">
<div class="list-group">
    <!-- <div class="row">
    <div class=" col-sm-3 alert alert-primary" role="alert">
    <?php 
        // echo "THAI AND PICKLIES (".$orderOject->getTodaysOrderCount().") ";
    ?>
    </div>
    <div class=" col-sm-3 " >
    <?php 
        // echo "THAI AND PICKLIES (".$orderOject->getTodaysOrderCount().") ";
    ?>
    
    <select class="form-control">
        <option value="" disabled selected>Choose your option</option>
        <option value="1">Option 1</option>
        <option value="2">Option 2</option>
        <option value="3">Option 3</option>
        </select>
    </p>
    </div>
    </div> -->
  <a href="" class="list-group-item list-group-item-action ">
    <div class="row">
    <div class="col-sm-4 results">
    <p style="color: green'">
    <?php 
        echo "ORDERS TOTAL : £ "."<span style='text-align: right;'>".$orderOject->getTotalOrderAmount()."</span>";

    ?>
    </p>
    <p>
    <?php 
        echo "Collection TOTAL : £ ".$orderOject->getTotalOrderCollectionAmount();
    ?>
    </p>
    <p>
    <?php 
        echo "Delivery TOTAL : £ ".$orderOject->getTotalDeliveryOrderAmount();

    ?>
     </p>
    
    </div>

    <div class="col-sm-4 results">
    <p>
    <?php 
        echo "Total Orders:  ".$orderOject->getOrderCount()." ";

    ?>
    </p>
    <p>
    <?php 
        echo "Total Collection Orders :  ".$orderOject->getOrderCollectionCount()." ";
    ?>
    </p>
    <p>
    <?php 
        echo "Total Delivery Orders :  ".$orderOject->getOrderDeliveryCount()." ";
    ?>
    </p>
    </div>
    <div class="col-sm-4 results">
    <p>
    <?php 
        echo "Total Cash: £ ".$orderOject->getTotalCashAmount()." ";

    ?>
    </p>
    <p>
    <?php 
        echo "Total Card : £ ".$orderOject->getTotalCardAmount()." ";
    ?>
    </p>
    <p>
    <?php 
        echo "Total paypal : £ ".$orderOject->getTotalPaypalAmount()." ";
    ?>
    </p>
    
    </div>

    </div>
  </a>
    
  <!-- <a href="#" class="list-group-item list-group-item-action">Second item</a>
  <a href="#" class="list-group-item list-group-item-action">Third item</a> -->
</div>
    <div id="page-inner">
    <div class="row">
        <div class="col-4">
           
        </div>
        <div class="col-6">
        
        </div>
        <div class="col-2">
            <!-- Print List -->
            <!-- <button id="printList" class="btn btn-sm pull-right btn-default" type="submit">Print Order List</button>
         -->
        </div>
    </div>
    <div class="row">
    
    <div class="col-md-12">
        <table id="orderList" class="table table-md table-responsive table-hover table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th scope="col" style="text-align:center; font-size: 12px;">Order No</th>
                <th scope="col" style="text-align:center; font-size: 12px;">CUSTOMER Details</th>
                <th scope="col" style="text-align:center; font-size: 12px;">Address</th>
                <th scope="col" style="text-align:center;font-size: 12px;">TYPE</th>
                <th scope="col" style="text-align:center;font-size: 12px;">TIME</th>
                <th scope="col" style="text-align:center;font-size: 12px;">TOTAL</th>
                <th scope="col" style="text-align:center;font-size: 12px;">DISCOUNT/CHARGE</th>
                <th scope="col" style="text-align:center;font-size: 12px;">METHOD</th>
                <th scope="col" style="text-align:center;font-size: 12px;">GRAND TOTAL</th>
                <th scope="col" style="text-align:center;font-size: 12px;">STATUS</th>
                <th scope="col" style="text-align:center;font-size: 12px;">ACTION</th>
            </tr>
        </thead>
        <tbody>
                                <!-- <script>
                                if(document.getElementById(orderList).innerHTML != xmlHttp.responseText)
                                    { 
                                        document.getElementById(orderList).innerHTML=xmlHttp.responseText;
                                        "ringbell.php",'toolbar=no, location=no, status=no,menubar=no,scrollbars=no, resizable=no,width=500, height=500');
                                        }
                                        
                                </script> -->
            <?php
            
        // return false;
                $orderTimeList=array();
                $orderStatus = "1";
                foreach($orderOject->allOrders()->orders as $allOrders){
                
                    
                    // foreach($allOrders->order as $order){
                        // print_r($allOrders->order->order_id); 
                        // echo "<br>";
                        // }
                        // $newOrderStatus = $allOrders->order->order_status;
                        // // echo $newOrderTime."<br>";
                        // if($newOrderStatus  == "0"){
                        //     // array_push($orderTimeList,$allOrders->order->order_time);
                        //     $orderId =  $allOrders->order->order_id;
                        //     // echo $orderId;
                        //     echo "<script>",
                        //     "window.open('ringbell.php?id=$orderId','targetWindow',",
                        //     "'toolbar=no, location=no, status=no,menubar=no,scrollbars=no, resizable=no,width=500, height=500');",
                        //         "</script>"
                            
                        //     ;
                        // }
                        
                            global $PrintText,$Statuscolor,$typeColor,$methodColor;
                        if($allOrders->order->order_status == "1"){
                            $Statuscolor = "green";
                            $status = "<i class='fa fa-print' aria-hidden='true' <br> Printed</i>";
                            $PrintText = "Reprint";
                        }else if($allOrders->order->order_status == "0"){
                            $Statuscolor = "red";
                            $status = "<i class='fa fa-print' aria-hidden='true'></i><br> Not Printed";
                            $PrintText = "Print";
                            
                        }else if($allOrders->order->order_status == "3"){
                            $Statuscolor = "#006a9b";
                            $status = "<i class='fa fa-motorcycle' aria-hidden='true'></i><br> Delivered";
                            $PrintText = "Print";
                            
                        }else{
                            
                            $Statuscolor = "#B65A16";
                            $status = "<i class='fa fa-clock' aria-hidden='true'></i><br> Pending";
                            $PrintText = "Reprint";
                        }

                        if($allOrders->order->order_type  == "Collection"){
                            $typeColor = "blue";
                        }else{
                            $typeColor = "orange";

                        }

                        if($allOrders->order->payment_method == "Card"){
                            $methodColor = "#02a9e6";
                        }else if($allOrders->order->payment_method == "Cash"){
                            $methodColor = "#004f16";

                        }else{
                            $methodColor = "#24397d";

                        }
                
                
            ?>
            <tr>
            <td style="text-align:center;font-size:12px;"><b><?php echo $allOrders->order->order_id ?></b></td>

                <td style="text-align:left;font-size:12px;"><?php 
                echo 
                'Name : '. $allOrders->order->customer_name .
                '<br/>Mobile : '. $allOrders->order->customer_phone .
                '<br/>Post Code : '. $allOrders->order->customer_postcode  ?></td>
                <td style="text-align:center;font-size:12px;"><b><?php echo $allOrders->order->customer_address ?></b></td>

                <td style="text-align:center;font-size:16px;font-weight:bold;"><span style="color:<?php echo $typeColor;?>;"><?php echo $allOrders->order->order_type ?></b></td>

                <td style="text-align:left;font-size:12px;"><?php
                $intimeString = "";
                $deliveryString = "";
                $orderString = "";

                    // $in = $allOrders->order->intime;
                    // $dtin = new DateTime("@$in",new DateTimezone('Europe/London'));  // convert UNIX timestamp to PHP DateTime
                    // $intime =  $dtin->format('g:i A');
                    $intime =  $allOrders->order->intime;

                    // $out = $allOrders->order->outtime;
                    // $dtout = new DateTime("@$out",new DateTimezone('Europe/London'));  // convert UNIX timestamp to PHP DateTime
                    // $outtime =  $dtout->format('g:i A');
                    $outtime =  $allOrders->order->outtime;

                    // $OrderTime =  date("H:i a",strtotime($allOrders->order->order_time));
                    $OrderTime =  $allOrders->order->order_time;

                $deleveryTime= $allOrders->order->delivery_or_collection_time;
                if($intime != 0){
                    $intimeString = "In Time : " . $intime."<br />"."Out Time : " . $outtime."<br />";
                }
                if($intime != ""){
                    $deliveryString = "Delivery Time : " .$deleveryTime."<br />";
                }
                if($OrderTime != ""){
                    $orderString = "Order Time : " . $OrderTime;
                }
                 echo 
                 $intimeString.
                 $deliveryString.
                 $orderString
                  ?></td>

                <td style="text-align:center;font-size:12px;"><b><?php echo $allOrders->order->sub_total ?></b></td>

                <td style="text-align:left;font-size:12px;">
                <?php 
                $discountString = "";
                $cardString = "";
                $deliveryString = "";
                $discount = $allOrders->order->discount;
                $cardCharge = $allOrders->order->card_charge;
                $deliveryCharge = $allOrders->order->delivery_charge;
                if($discount > 0){
                    $discountString = "Discount : " . $discount."<br />";
                }
                if($cardCharge > 0){
                    $cardString = "Card Charge : " .$cardCharge."<br />";
                }
                if($deliveryCharge > 0){
                    $deliveryString = "Delivery Charge : " . $deliveryCharge;
                }
                echo $discountString. $cardString. $deliveryString
                ?>
                </td>
                <td style="text-align:center;font-size:16px; font-weight:bold;"><span style="color:<?php echo $methodColor; ?>"><?php echo $allOrders->order->payment_method?></span></td>
                <td style="text-align:center;font-size:12px;"><b><?php echo $allOrders->order->total_amount ?></b></td>
                <td style="text-align:center; color:<?php echo $Statuscolor; ?>; font-size:24px;"><?php echo $status ?></td>
               
               <form action="" method="post">
               <td style="text-align:center; color: white"><a href="print_receipt.php?id=<?php echo $allOrders->order->order_id ?>" type="button" class="btn btn-sm mb-all btn-default" style="font-size: 16px;"><i class="fa fa-print" aria-hidden="true"></i>&nbsp;<?php echo $PrintText; ?></a></td>
                
               </form>
                
            </tr>
            
            <?php
                }
            //    echo $_SESSION['lastOrderTime'];
            ?> 
            
        </tbody>
        
        
    </table>
    <table id="orderList1" class="table table-lg table-responsive table-hover table-bordered display" style="width:100%">
        <thead>
            <tr>
                <th scope="col" style="text-align:center; font-size: 12px;">ORDERS TOTAL</th>
                <th scope="col" style="text-align:center; font-size: 12px;">Collection TOTAL</th>
                <th scope="col" style="text-align:center; font-size: 12px;">Delivery TOTAL </th>
                <th scope="col" style="text-align:center;font-size: 12px;">Total Orders</th>
                <th scope="col" style="text-align:center;font-size: 12px;">Total Collection Orders</th>
                <th scope="col" style="text-align:center;font-size: 12px;">Total Delivery Orders</th>
                <th scope="col" style="text-align:center;font-size: 12px;">Total Cash</th>
                <th scope="col" style="text-align:center;font-size: 12px;">Total Card</th>
                <th scope="col" style="text-align:center;font-size: 12px;">Total paypal</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td style="text-align:center; font-size: 16px; font-weight: bold;">
            <?php 
                    echo " £ ".$orderOject->getTotalOrderAmount();

                ?>
            </td>
            <td style="text-align:center; font-size: 16px; font-weight: bold;">
            <?php 
                    echo " £ ".$orderOject->getTotalOrderCollectionAmount();
                
            ?>
            </td>
            <td style="text-align:center; font-size: 16px; font-weight: bold;">
            <?php 
        echo " £ ".$orderOject->getTotalDeliveryOrderAmount();
                
            ?>
            </td>
            <td style="text-align:center; font-size: 16px; font-weight: bold;">
            <?php 
        echo "  ".$orderOject->getOrderCount()." ";
                
            ?>
            </td>
            <td style="text-align:center; font-size: 16px; font-weight: bold;">
            <?php 
        echo "  ".$orderOject->getOrderCollectionCount()." ";
                
            ?>
            </td>
            <td style="text-align:center; font-size: 16px; font-weight: bold;">
            <?php 
        echo "  ".$orderOject->getOrderDeliveryCount()." ";
                
            ?>
            </td>
            <td style="text-align:center; font-size: 16px; font-weight: bold;">
            <?php 
        echo " £ ".$orderOject->getTotalCashAmount()." ";
                
            ?>
            </td>
            <td style="text-align:center; font-size: 16px; font-weight: bold;">
            <?php 
        echo " £ ".$orderOject->getTotalCardAmount()." ";
                
            ?>
            </td>
            <td style="text-align:center; font-size: 16px; font-weight: bold;">
            <?php 
        echo " £ ".$orderOject->getTotalPaypalAmount()." ";
                
            ?>
            </td>
            </tr>
        </tbody>
        <br/><br/><hr/>
            </table>
<!--end of panel-->
    </div>
     <br>
    </div>
            <!-- /. PAGE INNER  -->
</div>
<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script> -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js" integrity="sha256-JIBDRWRB0n67sjMusTy4xZ9L09V8BINF0nd/UUUOi48=" crossorigin="anonymous"></script>

<script lang='javascript'> 
 // show hide date range
 $('#dateRangeName').on('click', function() {
        $("#dateRange").show();
    });


function printData()
{
    
}
 $(document).ready(function(){

    $("#dateRange").hide();
    

    //  datetimepicker
    $('.input-daterange input').each(function() {
    $(this).datepicker('clearDates');
    });

    // table data print
$( function() {
    $( "#datepicker" ).datepicker();
  } );

    $(function () {
        $('button[type="submit"]').click(function () {
            var pageTitle = 'Order List',
                stylesheet = '//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css',
                win = window.open('', 'Print', 'width=500,height=300');
            win.document.write('<html><head><title>' + pageTitle + '</title>' +
                '<link rel="stylesheet" href="' + stylesheet + '">' +
                '</head><body>' + $('#orderList')[0].outerHTML + $('#orderList1')[0].outerHTML+ '</body></html>');
            win.document.close();
            win.print();
            win.close();
            return false;
        });
    });
 });


// data table
// $(document).ready(function () {
    
// $('#orderList').DataTable();
// $('.dataTables_length').addClass('bs-select');
// });
</script>
<script lang="javascript" >
$(document).ready(function() {
    $('#orderList').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
    $('#orderList1').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'print'
        ]
    } );
} );
</script>

</body>
</html>
