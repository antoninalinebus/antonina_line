<?php
include("functions/db_functions.php");
error_reporting(0);  

if(isset($_POST['register']) && $_POST['process']=="register_user"){
    $register_user = register_login($connection, $_POST);
    header("location: login.php");
    
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Register Page</title>
    <link rel="icon" type="image/x-icon" href="images/logo.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/307dd57570.js" crossorigin="anonymous"></script>

    
</head>
<body>


  <section class="container forms">
    <div class="form login">
        <div class="form-content">
            <center><a href="index.php"><img src="images/logo.png" height="70px"></a></center>
            <header>Create Account</header>
            <form action = "" method="POST" enctype="multipart/form-data">
                <div class="field input-field">
                    <input type="text" placeholder="Full Name" class="input" name="fullName" required>
                </div>
                <div class="field input-field">
                    <input type="number" placeholder="Age" class="input" name="age" required>
                </div>
                <div class="field input-field">
                    <input type="date" placeholder="Birthdate" class="input" name="birthDate" required>
                </div>
                <div class="field input-field">
                    <input type="number" placeholder="Phone Number" class="input" name="phoneNumber" required maxlength="11" oninput="javascript:if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                </div>
                <div class="field input-field">
                    <input type="file" placeholder="Valid ID" class="input" name="validId" required>
                </div>
                <div class="field input-field">
                    <input type="email" placeholder="Email Address" class="input" name="email_address" required>
                </div>
                <div class="field input-field">
                    <input type="text" placeholder="Username" class="input" name="username" required>
                </div>

                <div class="field input-field">
                    <input type="password" placeholder="Password" class="password" name="password" required>
                    <i class='bx bx-hide eye-icon'></i>
                </div>

                <div class="field button-field">
                <input type='hidden' name='process' value='register_user' />
                    <button type='submit' name='register' id='register'>Register</button>
                </div>
            </form>
        </div>
    </div>
  </section>  
        

    



<!-- javascript -->

<script src="js/login.js"></script>

</body>
</html>