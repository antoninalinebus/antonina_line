<?php
include("functions/db_functions.php");
error_reporting(0); 
session_start(); 
if(!isset($_SESSION['id'])){
    header("location:error_page");
}
$id = $_GET['id'];

if(isset($_POST['logout']) && $_POST['process']=="logout_user"){
  $logout = user_logout();
}

if(isset($_POST['add']) && $_POST['process']=="add_user"){
  $add_user = approve_transaction($connection, $_POST, 2);
  $alert = alert_box('success', $add_user);
}

if(isset($_POST['delete']) && $_POST['process']=="delete_user"){
  $edit_user = disapprove_transaction($connection, $_POST);
  $alert = alert_box('delete', $edit_user);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
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
    .zoom:hover {
			transform: scale(3.00); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
		}
</style>
<body>

    <nav class="navbar navbar-light bg-dark d-flex w-100 display-fixed">
        <div class="container-fluid">
            <a class="navbar-brand p-4 text-light" href="admin.html">
                <img src="images/logo.png" alt="Logo" width="50" height="35" class="d-inline-block align-text-top ">
                AntoninaLine Bus Ticket System</a>
                <div class="login">
                    <span class="navbar-text p-2 text-light">
                        <span>Welcome</span>
                        <i class="fa-regular fa-circle-user"></i>
                        <form action = "" method="POST">
                        <input type='hidden' name='process' value='logout_user' />
                        <button type="submit" name='logout' class="btn btn-success">Logout</button>
                        </form>
                    </span>
                </div>
            </div>
        </nav>
    <?php
    if($_SESSION['role'] == 1) {
    ?>
    <div class="sidebar">
        <a href="adduser.php"><i class="fa-solid fa-users"></i> Drivers</a>
        <a href="bus.php"><i class="fa-solid fa-bus"></i> Buses</a>
        <a href="location.php"><i class="fa-solid fa-location-dot"></i> Location</a>
        <a href="settings.php"><i class="fa-solid fa-gear"></i> Settings</a>
        <a class="active" href="transaction.php"><i class="fa-solid fa-clipboard-check"></i> Transaction </a>
    </div>
    <?php 
    } else {
    ?>
    <div class="sidebar">
        <a class="active" href=""><i class="fa-solid fa-users"></i> Passengers</a>
    </div>
    <?php 
    } 
    ?>
    <div class="right-content">
        <div>
            <table>
              <tr>
                <th>ID</th>
                <th>Transaction ID</th>
                <th>Ticket</th>
                <th>Name</th>
                <th>Age</th>
                <th>ID Type</th>
                <th>ID Image</th>
                <th>Vaccination Card</th>
                <th>Sit Number</th>
                <th>Departure Date</th>
                <th>Status</th>                       
              </tr>
              <?php 
              $sql = mysqli_query($connection, "SELECT * FROM passenger_logs WHERE transaction_id = $id");
              while($data=mysqli_fetch_array($sql)) {
                $i++;
                $id = $data['id'];
                $transaction_id = $data['transaction_id'];
                $ticket = $data['ticket'];
                $name = $data['name'];
                $age = $data['age'];
                $discount_id_type = $data['discount_id_type'];
                $discount_id_image = $data['discount_id_image'];
                $vaccination_card = $data['vaccination_card'];
                $sit_number = $data['sit_number'];
                $departure_date = $data['departure_date'];
                $status = $data['status'];
                if($status == 0) $statusName = "Not approved";
                else $statusName = "Approved";

              echo "
              <tr>
                <td>$i</td>
                <td>$transaction_id</td>
                <td>$ticket</td>
                <td>$name</td>
                <td>$age</td>
                <td>$discount_id_type</td>
                <td><img class='zoom' style='width: 150px; object-fit: contain' src='upload_discount_id/$discount_id_image'></td>
                <td><img class='zoom' style='width: 150px; object-fit: contain' src='upload_vaccination_card/$vaccination_card'></td>
                <td>$sit_number</td>
                <td>$departure_date</td>
                <td>$statusName</td>    
              </tr>
              ";
              }
              ?>
            </table>
          </div>
    </div>
</body>
<script>
	function editData(id, name, bus_type , plate_number , bus_routes_id, hasDriver) {
		document.getElementById("id").value = id;
		document.getElementById("name").value = name;
		document.getElementById("bus_type").value = bus_type;
		document.getElementById("plate_number").value = plate_number;
		document.getElementById("bus_routes_id").value = bus_routes_id;
		document.getElementById("hasDriver").value = hasDriver;
	}

</script>
</html>
