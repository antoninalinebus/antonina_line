<?php
include("functions/db_functions.php");
error_reporting(0);  
session_start();
if($_SESSION['role'] != 1){
    header("location:error_page");
}

if(isset($_POST['logout']) && $_POST['process']=="logout_user"){
    $logout = user_logout();
}

if(isset($_POST['edit']) && $_POST['process']=="edit_user"){
  $edit_user = approve_transaction($connection, $_POST);
  $alert = alert_box('success', $edit_user);
}

if(isset($_POST['delete']) && $_POST['process']=="delete_user"){
  $delete_user = disapprove_transaction($connection, $_POST);
  $alert = alert_box('delete', $delete_user);
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
                        <span>Welcome, Admin</span>
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
        <a href="adduser.php"><i class="fa-solid fa-users"></i> Conductor</a>
        <a href="bus.php"><i class="fa-solid fa-bus"></i> Buses</a>
        <a href="location.php"><i class="fa-solid fa-location-dot"></i> Location</a>
        <a href="settings.php"><i class="fa-solid fa-gear"></i> Alert Level Settings</a>
        <a href="settings_fare.php"><i class="fa-solid fa-gear"></i> Bus Fare Settings</a>
        <a class="active" href="transaction.php"><i class="fa-solid fa-clipboard-check"></i> Transaction </a>
    </div>

    <div class="right-content">
        <div>
            <table>
              <tr>
                <th>ID</th>
                <th>Bus Name</th>
                <th>Bus Routes</th>
                <th>Destination</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>Passenger Count</th>
                <th>Payment Amount</th>
                <th>Total Payment</th>
                <th>Payment Date</th>
                <th>Payment Receipt</th>
                <th>Departure Date</th>
                <th>Departure Time</th>
                <th>Status</th>                       
              </tr>
              <?php 
              $sql = mysqli_query($connection, "SELECT transaction_logs.*, 
              buses.name as bus_name,
              CONCAT(bus_routes.location1, ' - ', bus_routes.location2 ) AS locationName
              FROM transaction_logs
              LEFT JOIN buses ON buses.id = transaction_logs.bus_id
              LEFT JOIN bus_routes ON bus_routes.id = transaction_logs.bus_routes_id");
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
                $total_payment_amount = $data['total_payment_amount'];
                $payment_receipt = $data['payment_receipt'];
                $payment_date = $data['payment_date'];
                $departure_date = $data['departure_date'];
                $departure_time = $data['departure_time'];
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
                <td>$payment_amount</td>
                <td>".number_format($total_payment_amount,2)."</td>
                <td>$payment_date</td>
                <td align='center'><img class='zoom' style='width: 150px; object-fit: contain' src='upload_receipt/$payment_receipt'></td>
                <td>$departure_date</td>
                <td>$departure_time</td>
                <td>$statusName</td>
                <td> <a href='transaction_view.php?id=$id' target='_blank'><i class='fa-solid fa-magnifying-glass'></i></a></td>
                    ";
                if($status == 0) {
                    echo "
                <td>
                    <form action = '' method='POST'>
                    <input type='hidden' name='id' value='$id'>
                    <input type='hidden' name='email' value='$email'>
                    <input type='hidden' name='departure_date' value='$departure_date'>
                    <input type='hidden' name='process' value='edit_user' />
                    <button type='submit' name='edit' id='edit' onclick=\"return  confirm('Are you sure you want to approve this? Y/N')\")><i class='fa-solid fa-check'></i></button>
                    </form>
                </td>
                <td>
                    <form action = '' method='POST'>
                    <input type='hidden' name='id' value='$id'>
                    <input type='hidden' name='email' value='$email'>
                    <input type='hidden' name='process' value='delete_user' />
                    <button type='submit' name='delete' id='del' onclick=\"return  confirm('Are you sure you want to delete this? Y/N')\")><i class='fa-solid fa-xmark'></i></button>
                    </form>
                </td>
                    ";
                }
                       
                  echo "
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
