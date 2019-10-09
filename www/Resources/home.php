<?php 
include 'Resources/newOrder.php';

?>

<div id="container">

<div id="page-wrapper">

    <div id="page-inner">
  
    <div class="row" id="passwordCheck">
        <div class="col-12">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <!-- Tabs Titles -->

                <!-- Icon -->
                <div class="fadeIn first userImage">
                <img src="img/user_icon.svg" id="icon" alt="User Icon" />
                </div>

                <!-- Login Form -->
                <form method="post">
                <!-- <input type="text" id="login" class="fadeIn text" name="email" placeholder="Email" required> -->
                <input type="password" id="password" class="fadeIn text" name="password" placeholder="Password" required>
                <br>
                <span id="message"></span>
                <!-- <input type="submit" class="fadeIn fourth" value="Log In"> -->
                </form>

                <!-- Remind Passowrd -->
                <div id="formFooter">
                <!-- <a class="underlineHover" href="#">Forgot Password?</a> -->
                </div>

            </div>
            </div>
        </div>
    </div>
    <div class="row" id="mainBody">

        <div class="col-4">
            <div class="main-box mb-red">
                <a href="">
                <i class="fas fa-hand-paper"></i>
                    <h5>Stop</h5>
                </a>
            </div>
        </div>

        <div class="col-8">
            <div class="main-box mb-all">
                <a id="myLink" href="javascript:showOrderList();">
                <i class="fas fa-print"></i>
                    <h5>Order List</h5>
                </a>
            </div>
        </div>

        <div class="col-6">
            <div class="main-box mb-all">
                <a id="printerSettings" href="javascript:openPage('printer');">
                <i class="fas fa-sliders-h"></i>
                    <h5>Printer Settings</h5>
                </a>
            </div>
        </div>


        <div class="col-6">
            <div class="main-box mb-all">
                <a id="restuarentSettings" href="javascript:openPage('restuarent');">
                <i class="fas fa-hotel"></i>
                    <h5>Restuarents</h5>
                </a>
            </div>
        </div>
        <div class="col-12 last-button">
            <div class="main-box mb-all">
                <a id="appSettings" href="javascript:openPage('app');">
                
                    <h5> <i class="fas fa-cogs" style="margin-top:15px;"></i> App Settings</h5>
                </a>
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-12">
            <img src="img/loading.gif" alt="Smiley face" height="32" width="40%" >
            <span style="font-size:11px; margin-bottom: -10px; color: #d86927 !important">Powered By THALI AND PICKLES</span>

        </div>
    </div>
    
            <!-- /. PAGE INNER  -->
</div>
    

        <!-- /. PAGE WRAPPER  -->
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>

<script>

$(document).ready(function() {
    $('#passwordCheck').hide();

});
</script>