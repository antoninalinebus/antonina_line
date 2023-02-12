<?php
include("functions/db_functions.php");
error_reporting(0);  

if(isset($_POST['login']) && $_POST['process']=="login_user"){
    $login_user = user_login($connection, $_POST);
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login Page</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/307dd57570.js" crossorigin="anonymous"></script>

    
</head>
<body>


  <section class="container forms">
    <div class="form login">
        <div class="form-content">
            <center><a href="index.php"><img src="images/logo.png" height="70px"></a></center>
            <header>Login</header>
            <form action="" method="POST">
                <div class="field input-field">
                    <input type="text" placeholder="Username" class="input" name="username">
                </div>

                <div class="field input-field">
                    <input type="password" placeholder="Password" class="password" name="password">
                    <i class='bx bx-hide eye-icon'></i>
                </div>

                <div class="field button-field">
                <input type='hidden' name='process' value='login_user' />
                    <button type='submit' name='login' id='login'>Login</button>
                </div>
                No account yet?<a href="register.php"> Register here </a>
            </form>
        </div>
    </div>
  </section>  
        

    



<!-- javascript -->

<script src="js/login.js"></script>

</body>
</html>