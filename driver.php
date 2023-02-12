<?php
include("functions/db_functions.php");
error_reporting(0);  
session_start();
    if($_SESSION['role'] != 2){
        header("location:admin.html");
    }
    if(isset($_SESSION['id'])){
      $id = $_SESSION['id'];
      $name = $_SESSION['name'];
    }

    if(isset($_POST['logout']) && $_POST['process']=="logout_user"){
      $logout = user_logout();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Antonina Line</title>
        <link rel="icon" type="image/x-icon" href="images/logo.png">
        <script src="https://kit.fontawesome.com/307dd57570.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/admin.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </head>
<style>
</style>
<body>

    <nav class="navbar navbar-light bg-dark d-flex w-100 display-fixed">
        <div class="container-fluid">
            <a class="navbar-brand p-4 text-light" href="#">
                <img src="images/logo.png" alt="Logo" width="50" height="35" class="d-inline-block align-text-top ">
                AntoninaLine Bus Ticket System</a>
                <div class="login">
                    <span class="navbar-text p-2 text-light">
                        <span>Conductor</span>
                        <i class="fa-regular fa-circle-user"></i>
                        <form action = "" method="POST">
                        <input type='hidden' name='process' value='logout_user' />
                        <button type="submit" name='logout' class="btn btn-success">Logout</button>
                        </form>
                    </span>
                </div>
            </div>
        </nav>

    <div class="sidebar">
        <a class="active" href=""><i class="fa-solid fa-users"></i> Passengers</a>
    </div>

    <div class="right-content">
        <div style="overflow-x:auto;">
            <table>
              <tr>
                <th>ID</th>
                <th>Bus Name</th>
                <th>Bus Routes</th>
                <th>Destination</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Passenger Count</th>
                <th>Departure Date</th>
                <th>Status</th>                          
              </tr>
              <?php 
              $sql = mysqli_query($connection, "SELECT transaction_logs.*,
              user_login.name as driverName,
                    buses.name as bus_name,
                    CONCAT(bus_routes.location1, ' - ', bus_routes.location2 ) AS locationName
                    FROM transaction_logs
                    LEFT JOIN buses ON buses.id = transaction_logs.bus_id
                    LEFT JOIN bus_routes ON bus_routes.id = transaction_logs.bus_routes_id
                    LEFT JOIN user_login ON user_login.bus_id = buses.id
                    WHERE user_login.id = $id AND transaction_logs.status = 1");
              while($data=mysqli_fetch_array($sql)) {
                $i++;
                $id = $data['id'];
                $bus_name = $data['bus_name'];
                $locationName = $data['locationName'];
                $destination = $data['destination'];
                $email = $data['email'];
                $contact_number = $data['contact_number'];
                $passenger_count = $data['passenger_count'];
                $payment_amount = $data['payment_amount'];
                $payment_receipt = $data['payment_receipt'];
                $payment_date = $data['payment_date'];
                $departure_date = $data['departure_date'];
                $status = $data['status'];
                if($status == 0) $statusName = "Not approved";
                else $statusName = "Approved";

              echo "
              <tr>
                <td>$i</td>
                <td>$bus_name</td>
                <td>$locationName</td>
                <td>$destination</td>
                <td>$email</td>
                <td>$contact_number</td>
                <td>$passenger_count</td>
                <td>$departure_date</td>
                <td>$statusName</td>
                <td> <a href='transaction_view.php?id=$id' target='_blank'><i class='fa-solid fa-magnifying-glass'></i></a></td>
              </tr>
              ";
              }
              ?>
            </table>
          </div>
    </div>

</body>
</html>
