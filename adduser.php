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
if(isset($_POST['add']) && $_POST['process']=="add_user"){
  $add_user = add_user($connection, $_POST, 2);
  $alert = alert_box('success', $add_user);
}
if(isset($_POST['edit']) && $_POST['process']=="edit_user"){
  $edit_user = edit_user($connection, $_POST);
  $alert = alert_box('edit', $edit_user);
}
if(isset($_POST['delete']) && $_POST['process']=="delete_user"){
  $edit_user = delete_user($connection, $_POST);
  $alert = alert_box('delete', $edit_user);
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
        <a class="active" href="adduser.php"><i class="fa-solid fa-users"></i> Conductor</a>
        <a href="bus.php"><i class="fa-solid fa-bus"></i> Buses</a>
        <a href="location.php"><i class="fa-solid fa-location-dot"></i> Location</a>
        <a href="settings.php"><i class="fa-solid fa-gear"></i> Alert Level Settings</a>
        <a href="settings.php"><i class="fa-solid fa-gear"></i> Bus Fare Settings</a>
        <a href="transaction.php"><i class="fa-solid fa-gear"></i> Transaction </a>
    </div>

    <div class="right-content">
        <div style="overflow-x:auto;">
            <table>
              <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Name</th>
                <th>Contact Number</th>
                <th>Bus Name</th>
                <th colspan="2" style="text-align: center;">
                    <button id="add" data-bs-toggle="modal" data-bs-target="#adds"><i class="fa-solid fa-plus"></i></button>
                </th>                        
              </tr>
              <?php 
              $sql = mysqli_query($connection, "SELECT user_login.*, buses.name AS bus_name FROM user_login LEFT JOIN buses ON buses.id = user_login.bus_id WHERE user_login.role = 2");
              while($data=mysqli_fetch_array($sql)) {
                $i++;
                $id = $data['id'];
                $username = $data['username'];
                $password = $data['password'];
                $name = $data['name'];
                $contact_number = $data['contact_number'];
                $bus_id = $data['bus_id'];
                $bus_name = $data['bus_name'];

              echo "
              <tr>
                <td>$i</td>
                <td>$username</td>
                <td>$password</td>
                <td>$name</td>
                <td>$contact_number</td>
                <td>$bus_name</td>
                <td>
                    <button onclick='editData(\"$id\", \"$username\", \"$password\" , \"$name\" , \"$contact_number\", \"$bus_id\", \"$bus_name\")' id='edit' data-bs-toggle='modal' data-bs-target='#edits'><i class='fa-solid fa-pen'></i></button>
                </td> 
                <td>
					<form action = '' method='POST'>
						<input type='hidden' name='id' value='$id'>
						<input type='hidden' name='bus_id' value='$bus_id'>
						<input type='hidden' name='process' value='delete_user' />
						<button type='submit' name='delete' id='del' onclick=\"return  confirm('Are you sure you want to delete this? Y/N')\")><i class='fa-solid fa-trash-can'></i></button>
					</form>
                </td>                        
              </tr>
              ";
              }
              ?>
            </table>
          </div>
    </div>

    <!-- Modal Body ADD -->
    <div class="modal fade" id="adds" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <form action = "" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Add</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="modal-body">
                <div class="md-form">
                  <label data-error="wrong" data-success="right" for="form2">Username</label>
                  <input type="text" required name="username" class="form-control validate">
                </div>

                <div class="md-form">
                  <label data-error="wrong" data-success="right" for="form2">Password</label>
                  <input type="text" required name="password" class="form-control validate">
                </div>
                <div class="md-form">
                  <label data-error="wrong" data-success="right" for="form2">Name</label>
                  <input type="text" required name="name" class="form-control validate">
                </div>
                <div class="md-form">
                  <label data-error="wrong" data-success="right" for="form2">Contact Number</label>
                  <input type="number" name="contact_number" onKeyPress="if(this.value.length==11) return false;" class="form-control validate">
                </div>
                <div class="md-form">
                    <label data-error="wrong" data-success="right" for="form2">Bus</label>
                    <?php 
                    $sql = mysqli_query($connection, "SELECT * FROM buses");
                    echo "<select class='form-control validate' name='bus_id'>";
                    while($data=mysqli_fetch_array($sql)) {
                        echo "<option value='".$data['id']."'"; if($data['hasDriver']==1) echo "disabled"; echo ">".$data['name']."</option>";
                    }
                    echo "</select>"; 
                    ?>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input type="hidden" name="process" value="add_user" />
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="submit" name="add" class="btn btn-primary">
            </div>
          </div>
        </form>
        </div>
    </div>

    <!-- Modal Body Edit -->
    <div class="modal fade" id="edits" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <form action = "" method="POST">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="modal-body">
                <div class="md-form mb-3">
                  <!-- <i class="fas fa-user prefix grey-text"></i> -->
                  <label data-error="wrong" data-success="right" for="form3">ID</label>
                  <input type="text" required id="id" name="id" class="form-control validate" readonly>
                </div>

                <div class="md-form">
                  <!-- <i class="fas fa-envelope prefix grey-text"></i> -->
                  <label data-error="wrong" data-success="right" for="form2">Username</label>
                  <input type="text" required id="username" name="username" class="form-control validate">
                </div>

                <div class="md-form">
                  <!-- <i class="fas fa-envelope prefix grey-text"></i> -->
                  <label data-error="wrong" data-success="right" for="form2">Password</label>
                  <input type="text" required id="password" name="password" class="form-control validate">
                </div>
                <div class="md-form">
                  <!-- <i class="fas fa-envelope prefix grey-text"></i> -->
                  <label data-error="wrong" data-success="right" for="form2">Name</label>
                  <input type="text" required id="name" name="name" class="form-control validate">
                </div>
                <div class="md-form">
                  <!-- <i class="fas fa-envelope prefix grey-text"></i> -->
                  <label data-error="wrong" data-success="right" for="form2">Contact Number</label>
                  <input type="number" onKeyPress="if(this.value.length==11) return false;"  id="contact_number" name="contact_number" class="form-control validate">
                </div>
                <div class="md-form">
                    <label data-error="wrong" data-success="right" for="form2">Bus</label>
                    <?php 
                    $sql = mysqli_query($connection, "SELECT * FROM buses");
                    echo "<select class='form-control validate' name='bus_id' id='bus_id'>";
                    while($data=mysqli_fetch_array($sql)) {
                        echo "<option value='".$data['id']."'"; if($data['hasDriver']==1) echo "disabled"; echo ">".$data['name']."</option>";
                    }
                    echo "</select>"; 
                    ?>
                </div>
              </div>
            </div>
            <div class="modal-footer">
            <input type="hidden" name="process" value="edit_user" />
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <input type="submit" name="edit" class="btn btn-primary">
            </div>
          </div>
        </form>
        </div>
    </div>


</body>
<script>
	function editData(id, username, password, name, contact_number, bus_id, bus_name) {
		document.getElementById("id").value = id;
		document.getElementById("username").value = username;
		document.getElementById("password").value = password;
		document.getElementById("name").value = name;
		document.getElementById("contact_number").value = contact_number;
		document.getElementById("bus_id").value = bus_id;
	}

</script>
</html>
