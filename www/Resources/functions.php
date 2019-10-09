<?php
        include 'Resources/variables.php';
// session_start();
class auth {

   public static function is_connected()
    {
        $connected = @fsockopen("www.example.com", 80); 
                                            //website, port  (try 80 or 443)
        if ($connected){
            $is_conn = true; //action when connected
            fclose($connected);
        }else{
            $is_conn = false; //action in connection failure
        }
        return $is_conn;

    }

    public static function CheckCirficate(){$validationDate = date('m');$validationYear = date('y');if(auth::checkLoginState() || ($validationDate < 12 && $validationYear <= 2019)){return true;}return false;}
    public static function checkLoginState(){
                    $apilist = PDO_FetchAll("SELECT * FROM apilist");
                    foreach($apilist as $api){
                    //   $toneDetails = PDO_FetchAll("SELECT * FROM ringtonelist WHERE toneid=".$tone['toneid']);
                    if($api['apiname'] == "login"){
                    $login = $api['apilink'];

                    }
                }
        // if(!isset($_SESSION['auth'])){
        //     session_start();
        // }
        if($login == "9c6b90da21dfcdd6f0527a023785090c"){

            return true;
        }
       
        return false;
    }

    public static function login($email, $password){
        include 'Resources/variables.php';
        if($email != ""){
            
            $curl = curl_init();
            $auth_data = array(
                'email' 	=> $email,
                'password' 	=> $password
            );

            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);
            // curl_setopt($curl, CURLOPT_URL, 'http://mukith.site/ooapi/adminlogin');
            curl_setopt($curl, CURLOPT_URL, $url.$login);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

            $content = curl_exec($curl);
            if(!$content){die("Connection Failure");}

            $result = json_decode($content);

            if($result->status == 1){
                session_start();
                $_SESSION['auth'] = true;
                $_SESSION['email'] = $result->user->email;
                $_SESSION['name'] = $result->user->name;
                $_SESSION['user_type'] = $result->user->user_type;
                $_SESSION['login_time'] = $result->user->login_time;
                $_SESSION['token'] = $result->user->auth_code;

            }else{
                return false;
            }
            curl_close($curl);
            return $result->user->user_status;
        
        }
        return false;
    }
}



class OrderProperties
{
    /**  Location for overloaded data.  */
    private $data = array();

    /**  Overloading not used on declared properties.  */
    public $declared = 1;

    /**  Overloading only used on this when accessed outside the class.  */
    private $hidden = 2;

    public function __set($name, $value)
    {
        // echo "Setting '$name' to '$value'<br>";
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        // echo "Getting '$name'<br>";
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
    }

    /**  As of PHP 5.1.0  */
    public function __isset($name)
    {
        echo "Is '$name' set?\n<br>";
        return isset($this->data[$name]);
    }

    /**  As of PHP 5.1.0  */
    public function __unset($name)
    {
        echo "Unsetting '$name'\n";
        unset($this->data[$name]);
    }

    /**  Not a magic method, just here for example.  */
    public function getHidden()
    {
        return $this->hidden;
    }
}

class orderList {

    public $list;
    public $orderCount = 0;
    public $orderCollectionCount = 0;
    public $orderDeliveryCount = 0;
    public $todaysOrderCount = 0;
    public $totalOrderAmount = 0;
    public $totalCashAmount = 0;
    public $totalCardAmount = 0;
    public $totalPaypalAmount = 0;
    public $totalCollectionOrderAmount = 0;
    public $totalDeliveryOrderAmount = 0;

    public function __construct($link = "https://www.thaliandpickles.co.uk/ooapi/current_order/today") {
        if($link == ""){
        include 'Resources/variables.php';
        $link = $url.$filter."daily";

        echo $link;
        exit;
        }
        global $list;
        // $content = file_get_contents("http://mukith.site/ooapi/new_orders");
        $content = file_get_contents($link);
        
        
        $list = json_decode($content);
        // echo "<pre>";
        // print_r($list);
        // echo "<pre>";
        // exit;
        $propertyObject = new OrderProperties;
        $OrderCount = 0;
        
        $OrderCollectionCount = 0;
        $OrderDeliveryCount = 0;
        $totalAmount = 0;
        $totalCash = 0;
        $totalCard = 0;
        $totalPaypal= 0;
        $totalCollectionAmount = 0;
        $totalDeliveryAmount = 0;

        date_default_timezone_set('UTC');
        $todate = date('Y-m-d');
        $TodaysOrderCount = 0;

        // process
        foreach($list->orders as $allOrders){

            // $date = new DateTime($allOrders->order->order_time);
            // $date = new DateTime($allOrders->order->order_time);
            // $my_dt = DateTime::createFromFormat('m-d-Y H:i:s', $allOrders->order->order_time);
            $date = DateTime::createFromFormat('Y-m-d', $allOrders->order->order_time);

            // var_dump($date);
            // exit;
            // $date = $date->format('Y-m-d');
            // for total todays orders count
            if($date == $todate){
                $TodaysOrderCount++;
            }

            // for total orderamount count
           $totalAmount += $allOrders->order->total_amount;
           if($allOrders->order->order_type == "Collection")
           {
                    $totalCollectionAmount += $allOrders->order->total_amount;
                    $OrderCollectionCount++;
            }
            else if($allOrders->order->order_type == "Delivery")
            {
                    $totalDeliveryAmount += $allOrders->order->total_amount;
                    $OrderDeliveryCount++;
            }else{

            }
            if($allOrders->order->payment_method == "Cash"){
                $totalCash += $allOrders->order->total_amount;
            }
            if($allOrders->order->payment_method == "Card"){
                $totalCard += $allOrders->order->total_amount;
            }
            if($allOrders->order->payment_method == "Paypal"){
                $totalPaypal += $allOrders->order->total_amount;
            }
        
            // for total order count
                $OrderCount++;
            }

        // settings
        $propertyObject->orderCount = $OrderCount;
        $propertyObject->orderCollectionCount = $OrderCollectionCount;
        $propertyObject->orderDeliveryCount = $OrderDeliveryCount;
        $propertyObject->todaysOrderCount = $TodaysOrderCount;
        $propertyObject->totalOrderAmount = $totalAmount;
        $propertyObject->totalCashAmount = $totalCash;
        $propertyObject->totalCardAmount = $totalCard;
        $propertyObject->totalPaypalAmount = $totalPaypal;
        $propertyObject->totalOrderCollectionAmount = $totalCollectionAmount;
        $propertyObject->totalOrderDeliveryAmount = $totalDeliveryAmount;

        // private variable value inisializations
        $this->list = $list;
        
        $this->orderCount = $propertyObject->orderCount;
        $this->orderCollectionCount = $propertyObject->orderCollectionCount;
        $this->orderDeliveryCount = $propertyObject->orderDeliveryCount;
        $this->todaysOrderCount = $propertyObject->todaysOrderCount;
        
        $this->totalOrderAmount = $propertyObject->totalOrderAmount;
        $this->totalCashAmount = $propertyObject->totalCashAmount;
        $this->totalCardAmount = $propertyObject->totalCardAmount;
        $this->totalPaypalAmount = $propertyObject->totalPaypalAmount;
        $this->totalCollectionOrderAmount = $propertyObject->totalOrderCollectionAmount;
        $this->totalDeliveryOrderAmount = $propertyObject->totalOrderDeliveryAmount;
    }
    

    // all get methods
    public function allOrders() {
        return $this->gatList();
    }

    public function gatList() {
        return $this->list;
    }
    public function getOrderCount() {
        return $this->orderCount;
    }
    public function getOrderCollectionCount() {
        return $this->orderCollectionCount;
    }
    public function getOrderDeliveryCount() {
        return $this->orderDeliveryCount;
    }
    public function getTodaysOrderCount() {
        return $this->todaysOrderCount;
    }
    public function getTotalOrderAmount() {
        return $this->totalOrderAmount;
    }
    public function getTotalCashAmount() {
        return $this->totalCashAmount;
    }
    public function getTotalCardAmount() {
        return $this->totalCardAmount;
    }
    public function getTotalPaypalAmount() {
        return $this->totalPaypalAmount;
    }
    public function getTotalOrderCollectionAmount() {
        return $this->totalCollectionOrderAmount;
    }
    public function getTotalDeliveryOrderAmount() {
        return $this->totalDeliveryOrderAmount;
    }
}



?>