<?php
include("db_config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

    function send_email($email, $ticket, $name, $age, $departure_date, $bus_name, $departure_time, $sit_number) {
        $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'antoninalinebus@gmail.com';                     //SMTP username
                $mail->Password   = 'egtdclhcvhnnsmwq';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('antonina_line@noreply.com', 'Antonina Line Bus System');
                $mail->addAddress("$email");     //Add a recipient
                
                $message = "Name: ".$name."<br>"."Age: ".$age."<br>"."Ticket: ".$ticket;
                $message = "Hello Passenger ".$name.", we received your fare payment. Here is your Official Receipt and your ticket number is <strong>".$ticket.".</strong> The Station is located at Ubaliw Polangui Albay (behind the Old LCC). Your book schedule is ".$departure_date.". DEPARTURE TIME ".$departure_time.". Seat number is Number ".$sit_number.". Kindly show your ticket number to the conductor of the bus. Thank you so much! Have a safe travel our dear passenger! - Antonina Line";
                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Antonina-line Ticket';
                $mail->Body    = $message;

                $mail->send();
                // echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
    }    

    function getRandomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    function register_login($connection,$data){
        $name = $data['fullName'];
        $age = $data['age'];
        $birthdate = $data['birthDate'];
        $contact_number = $data['phoneNumber'];
        $email_address = $data['email_address'];
        $username = $data['username'];
        $password = $data['password'];

        $pdt_img_name = $_FILES['validId']['name'];
        $pdt_img_size = $_FILES['validId']['size'];
        $pdt_img_tmp = $_FILES['validId']['tmp_name'];
        $img_ext = pathinfo($pdt_img_name, PATHINFO_EXTENSION);

        list($width, $height) = getimagesize("$pdt_img_tmp");

        if ($img_ext == "jpg" ||  $img_ext == 'jpeg' || $img_ext == "png") {
            if ($pdt_img_size <= 2e+6) {

                $user_check = "SELECT * FROM `user_login` WHERE username='$username'";
                $mysqli_result = mysqli_query($connection, $user_check);
                $row = mysqli_num_rows($mysqli_result);

                if ($row == 1) {
                    $msg = "Username already exist";
                    return $msg;
                } else {
        
                $query1 = "INSERT INTO `user_login`( `username`, `password`, `name`, `age`, `birthdate`, `contact_number`,`email_address`, `valid_id`, `role`, `bus_id`) VALUES ('$username','$password','$name','$age','$birthdate','$contact_number','$email_address', '$pdt_img_name', 3, NULL)";
                if(mysqli_query($connection, $query1)){
                    move_uploaded_file($pdt_img_tmp, "upload_validid/".$pdt_img_name);
                    $msg="Successfully added {$username}";
                    return $msg;
                }

                }
                
                
            }
        }
        header("location: login.php");
        
    }

    function user_login($connection,$data) {
        $username = $data['username'];
        $password = $data['password'];

        $query = "SELECT * FROM `user_login` WHERE `username`='$username' AND `password`='$password'";

        if (mysqli_query($connection, $query)) {
            $result = mysqli_query($connection, $query);
            $user_info = mysqli_fetch_array($result);
            if ($user_info) {

                if($user_info['role'] == 1) {
                    header("location:../adduser.php");
                }
                else if($user_info['role'] == 2) {
                    header("location:../driver.php");
                }
                else if($user_info['role'] == 3) {
                    header("location:../index.php");
                }
                
                session_start();
                $_SESSION['id'] = $user_info['id'];
                $_SESSION['username'] = $user_info['username'];
                $_SESSION['password'] = $user_info['password'];
                $_SESSION['name'] = $user_info['name'];
                $_SESSION['contact_number'] = $user_info['contact_number'];
                $_SESSION['email_address'] = $user_info['email_address'];
                $_SESSION['valid_id'] = $user_info['valid_id'];
                $_SESSION['role'] = $user_info['role'];
                $_SESSION['bus_id'] = $user_info['bus_id'];
                $id=$user_info['id'];

                $query2 = "UPDATE `user_login` SET `is_login` = '1' WHERE `id` = '$id'";
              if (mysqli_query($connection, $query2)) {
            }

            } else {
                $logmsg = "Your username or password is incorrect";
                return $logmsg;
            }
        }

    }

    function user_logout() {
        unset($_SESSION['id']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['name']);
        unset($_SESSION['contact_number']);
        unset($_SESSION['role']);
        unset($_SESSION['bus_id']);

        header("location:../login.php");
        session_destroy();
    }

    function transaction($connection,$data) {
        $bus_id = $data['bus_id'];
        $bus_routes_id = $data['bus_routes_id'];
        $departure_time = $data['departure_time'];
        $destination = $data['destination'];
        $email = $data['email'];
        $contact_number = $data['contact_number'];
        $passenger_count = $data['passenger_count'];
        $payment_amount = $data['payment_amount'];
        $total_payment_amount = $data['total_payment_amount'];
        $payment_date = $data['payment_date'];
        $departure_date = $data['departure_date'];
        $status = 0;
        

        // print_r($data);
        $sql1 = mysqli_fetch_array(mysqli_query($connection, "SELECT MAX(id) as maxid FROM transaction_logs"));
        $maxid = $sql1['maxid']+1;

        $pdt_img_name = $_FILES['imageData']['name'];
        $pdt_img_size = $_FILES['imageData']['size'];
        $pdt_img_tmp = $_FILES['imageData']['tmp_name'];
        $img_ext = pathinfo($pdt_img_name, PATHINFO_EXTENSION);

        list($width, $height) = getimagesize("$pdt_img_tmp");

        if ($img_ext == "jpg" ||  $img_ext == 'jpeg' || $img_ext == "png") {
            if ($pdt_img_size <= 2e+6) {
                $query1 = "INSERT INTO `transaction_logs`( `bus_id`, `bus_routes_id`,`destination`, `email`, `contact_number`, `passenger_count`, `payment_amount`, `total_payment_amount`, `payment_receipt`, `payment_date`, `departure_date`, `departure_time`, `status`) VALUES ('$bus_id','$bus_routes_id','$destination','$email','$contact_number', '$passenger_count', '$payment_amount', '$total_payment_amount','$pdt_img_name', '$payment_date', '$departure_date', '$departure_time', '$status')";
                if(mysqli_query($connection, $query1)){
                    move_uploaded_file($pdt_img_tmp, "upload_receipt/".$pdt_img_name);
                }
            }
        }

       
        
        for($count=1; $count<=$passenger_count; $count++) {
            $name = $data['name'][$count];
            $age = $data['age'][$count];
            $sit_number = $data['sit_number'][$count];
            $ticket = getRandomString(10);
            $discount_id_type = $data['discountIDType'][$count];
            if($data['discountIDType'][$count] == 1) $discount_id_type = "";
            else if($data['discountIDType'][$count] == 2) $discount_id_type = "Senior Citizen";
            else if($data['discountIDType'][$count] == 3) $discount_id_type = "Person With Disability";

            if(isset($_FILES['discountImageData']['name'][$count])) {
                $discount_img_name = $_FILES['discountImageData']['name'][$count];
                $discount_img_size = $_FILES['discountImageData']['size'][$count];
                $discount_img_tmp = $_FILES['discountImageData']['tmp_name'][$count];
                $discount_img_ext = pathinfo($discount_img_name, PATHINFO_EXTENSION);

                list($width, $height) = getimagesize("$discount_img_tmp");

                if ($discount_img_ext == "jpg" ||  $discount_img_ext == 'jpeg' || $discount_img_ext == "png") {
                    if ($pdt_img_size <= 2e+6) {
                        move_uploaded_file($discount_img_tmp, "upload_discount_id/".$discount_img_name);
                    }
                } 
            }

            if(isset($_FILES['uploadVaccinationData']['name'][$count])) {
                $vaccination_img_name = $_FILES['uploadVaccinationData']['name'][$count];
                $vaccination_img_size = $_FILES['uploadVaccinationData']['size'][$count];
                $vaccination_img_tmp = $_FILES['uploadVaccinationData']['tmp_name'][$count];
                $vaccination_img_ext = pathinfo($vaccination_img_name, PATHINFO_EXTENSION);

                list($width, $height) = getimagesize("$vaccination_img_tmp");

                if ($vaccination_img_ext == "jpg" ||  $vaccination_img_ext == 'jpeg' || $vaccination_img_ext == "png") {
                    if ($pdt_img_size <= 2e+6) {
                        move_uploaded_file($vaccination_img_tmp, "upload_vaccination_card/".$vaccination_img_name);
                    }
                } 
            }
            
            
            $query2 = "INSERT INTO `passenger_logs`( `transaction_id`, `bus_id`, `ticket`, `name`, `age`, `vaccination_card`, `discount_id_type`, `discount_id_image`, `sit_number`, `departure_date`, `departure_time`, `status`) VALUES ('$maxid','$bus_id','$ticket','$name', '$age', '$vaccination_img_name', '$discount_id_type', '$discount_img_name', '$sit_number', '$departure_date', '$departure_time', '$status')";
            mysqli_query($connection, $query2);
        }

        header("location: index.php");
    }

    function approve_transaction($connection,$data) {
        $transaction_id = $data['id'];
        $email = $data['email'];
        // echo $transaction_id;
        $sql = mysqli_query($connection, "SELECT passenger_logs.*, buses.name as bus_name FROM passenger_logs 
        LEFT JOIN buses ON buses.id = passenger_logs.bus_id
        WHERE `transaction_id` = '$transaction_id'");
        while($row=mysqli_fetch_array($sql)) {
            $id = $row['id'];
            $name = $row['name'];
            $age = $row['age'];
            $ticket = $row['ticket'];
            $bus_name = $row['bus_name'];
            $departure_date = $row['departure_date'];
            $departure_time = $row['departure_time'];
            $sit_number = $row['sit_number'];

            $query1 = "UPDATE `passenger_logs` SET `ticket` = '$ticket',`status` ='1' WHERE `id` = '$id'";
            $query2 = "UPDATE `transaction_logs` SET `status` ='1' WHERE `id` = '$transaction_id'";
            mysqli_query($connection, $query1);
            mysqli_query($connection, $query2);

            $sample = send_email("$email", "$ticket", "$name", "$age", "$departure_date", "$bus_name", "$departure_time", "$sit_number");
        }
        $msg="Successfully Approved Transaction!";
        return $msg;
    }

    function disapprove_transaction($connection,$data) {
        $transaction_id = $data['id'];
        $email = $data['email'];

        $sql = mysqli_query($connection, "SELECT * FROM passenger_logs WHERE `transaction_id` = '$transaction_id'");
        while($row=mysqli_fetch_array($sql)) {
            $id = $row['id'];
            $name = $row['name'];
            $age = $row['age'];
            $ticket = $row['ticket'];
            $query1 = "DELETE FROM `passenger_logs` WHERE `id` = '$id'";
            $query2 = "DELETE FROM `transaction_logs` WHERE `id` = '$transaction_id'";
            mysqli_query($connection, $query1);
            mysqli_query($connection, $query2);
        }
        $msg="Successfully Deleted Transaction!";
        return $msg;
    }

    /* ---  Add, Edit, Delete Users --- */
    function add_user($connection,$data){
        $username = $data['username'];
        $password = $data['password'];
        $name = $data['name'];
        $contact_number = $data['contact_number'];  
        $bus_id = $data['bus_id'];
            
        
        $user_check = "SELECT * FROM `user_login` WHERE username='$username'";
        $mysqli_result = mysqli_query($connection, $user_check);
        $row = mysqli_num_rows($mysqli_result);

        if ($row == 1) {
            $msg = "Username already exist";
            return $msg;
        } else {

        $query1 = "INSERT INTO `user_login`( `username`, `password`, `name`, `contact_number`, `role`, `bus_id`) VALUES ('$username','$password','$name','$contact_number', 2, '$bus_id')";
        $query2 = "UPDATE `buses` SET `hasDriver` ='1' WHERE `id` = '$bus_id'";

        if(mysqli_query($connection, $query1)){
            mysqli_query($connection, $query2);
            $msg="Successfully added {$username}";
            return $msg;
        }
        }
    }

    function edit_user($connection,$data){
            $id = $data['id'];
            $username = $data['username'];
            $password = $data['password'];
            $name = $data['name'];
            $contact_number = $data['contact_number'];  
        

        $query1 = "UPDATE `user_login` SET `username` = '$username', `password` = '$password', `name` = '$name', `contact_number` = '$contact_number' WHERE `id` = '$id'";

        if(mysqli_query($connection, $query1)){
            $msg="Successfully updated {$username}";
            return $msg;
        }
    }

    function delete_user($connection,$data){
        $id = $data['id'];
        $bus_id = $data['bus_id'];
    
        $query1 = "UPDATE `buses` SET `hasDriver` ='0' WHERE `id` = '$bus_id'";
        $query2 = "DELETE FROM user_login WHERE `id` = '$id'";


        if(mysqli_query($connection, $query2)){
            mysqli_query($connection, $query1);
            $msg="Successfully Deleted User!";
            return $msg;
        }
    }
    /* End */

    /* ---  Add, Edit, Delete Buses --- */
    function add_buses($connection,$data){
        $name = $data['name'];
        $bus_type = $data['bus_type'];
        $plate_number = $data['plate_number'];  
        $bus_routes_id = $data['bus_routes_id'];
        $hasDriver = 0;

        $query1 = "INSERT INTO `buses`( `name`, `bus_type`, `plate_number`, `bus_routes_id`, `hasDriver`) VALUES ('$name','$bus_type','$plate_number','$bus_routes_id','$hasDriver')";        
        
        if(mysqli_query($connection, $query1)){
            $msg="{$name} add as a bus successfully";
            return $msg;
        }
    }

    function edit_buses($connection,$data){
            $id = $data['id'];
            $name = $data['name'];
            $bus_type = $data['bus_type'];
            $plate_number = $data['plate_number'];  
            $bus_routes_id = $data['bus_routes_id'];
            $hasDriver = $data['hasDriver'];
        

        $query1 = "UPDATE `buses` SET `name` = '$name', `bus_type` = '$bus_type', `plate_number` = '$plate_number', `bus_routes_id` = '$bus_routes_id', `hasDriver` = '$hasDriver' WHERE `id` = '$id'";

        if(mysqli_query($connection, $query1)){
            $msg="Successfully updated {$name}";
            return $msg;
        }
    }

    function delete_buses($connection,$data){
        $id = $data['id'];

        $query1 = "DELETE FROM buses WHERE `id` = '$id'";

        if(mysqli_query($connection, $query1)){
            $msg="Successfully Deleted Bus!";
            return $msg;
        }
    }
    /* End */

    /* ---  Add, Edit, Delete Bus Routes --- */
    function add_bus_routes($connection,$data){
        $location1 = strtoupper($data['location1']);
        $location2 = strtoupper($data['location2']);
        $colour = dechex(rand(0, 10000000));
        
        $query1 = "INSERT INTO `bus_routes`( `location1`, `location2`, `colour`) VALUES ('$location1','$location2','$colour')";

        if(mysqli_query($connection, $query1)){
            $msg="Successfully added routes";
            return $msg;
        }
    }


    function edit_bus_routes($connection,$data){
            $id = $data['id'];
            $location1 = strtoupper($data['location1']);
            $location2 = strtoupper($data['location2']);  
        

        $query1 = "UPDATE `bus_routes` SET `location1` = '$location1', `location2` = '$location2' WHERE `id` = '$id'";

        if(mysqli_query($connection, $query1)){
            $msg="Successfully updated routes";
            return $msg;
        }
    }

    /* End */

    /* Edit Alert Level Settings */
    function edit_settings($connection, $data) {
        $id = $data['id'];
        $alert_level = $data['alert_level'];
     
        $query1 = "UPDATE `settings` SET `alert_level` = '$alert_level' WHERE `id` = '$id'";

        if(mysqli_query($connection, $query1)){
            $msg="Successfully updated {$alert_level}";
            return $msg;
        }
    }

    /* Edit Bus Fare Settings */
    function edit_settings_fare($connection, $data) {
        $id = $data['id'];
        $fare = $data['fare'];
     
        $query1 = "UPDATE `bus_fare` SET `fare` = '$fare' WHERE `id` = '$id'";

        if(mysqli_query($connection, $query1)){
            $msg="Successfully updated {$alert_level}";
            return $msg;
        }
    }

    function alert_box($data, $msg) {

        if($data == 'success') {
            echo "
            <div style='position: absolute; top: 550px; margin-left: 30%; margin-right: 30%; width: 100% min-width: 150px; max-width: 400px;' class=''>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                $msg
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>×</button>
                </div>
            </div>
        ";
        } else if($data == 'edit') {
            echo "
            <div style='position: absolute; top: 30%; left:15%; width: 50%' class='container mt-5-'>
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                $msg
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>×</button>
                </div>
            </div>
        ";
        } else if($data == 'delete') {
            echo "
            <div style='position: absolute; top: 30%; left:15%; width: 50%' class='container mt-5-'>
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                $msg
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>×</button>
                </div>
            </div>
        ";
        }
    }
?>