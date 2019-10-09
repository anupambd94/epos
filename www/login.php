<?php
ob_start();

 include_once 'Resources/header.php';
 include_once 'Resources/functions.php';
?>

<section class="parent">
    <div class="child">
    <?php 
        if(!auth::checkLoginState()){
            if(isset($_POST['email']) && isset($_POST['password'])){
              // admin@onlineorder.com
                $email = $_POST['email'];
                $password = $_POST['password'];

                $getLogedIn = auth::login($email, $password);
                if($getLogedIn == 1){
                    header('location: index.php');
                }else{
                    echo "
                    <div class=\"alert alert-danger center\" role=\"alert\" style='padding: 0px 10px; text-align: center;'>
                    Invalid email/password or user is not active.
                  </div>
                     ";
                }

            }
        }else{
            header('location: index.php');
        }
    ?>


    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first userImage">
      <img src="img/user_icon.svg" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
    <form method="post">
      <input type="text" id="login" class="fadeIn text" name="email" placeholder="Email" required>
      <input type="password" id="password" class="fadeIn text" name="password" placeholder="Password" required>
      <input type="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <!-- <a class="underlineHover" href="#">Forgot Password?</a> -->
    </div>

  </div>
</div>
    </div>
</section>



<?php include_once 'Resources/footer.php';?>