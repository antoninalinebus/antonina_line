<?php
include("functions/db_functions.php");
error_reporting(0);
session_start();
if($_SESSION['role'] != 3){
    header("location:login.php");
}  
if(isset($_POST['passenger_count'])) {
  $date = $_POST['date'];
  $location = $_POST['trips'];
  $passenger_count = (int)$_POST['passenger_count'];
  $bus_id = $_POST['bus_id'];
  $bus_type = $_POST['bus_type'];
  $bus_routes_id = $_POST['bus_routes_id'];
  $departure_time = $_POST['departure_time'];
  $title = $location." "."($date)";

  $fareData = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM bus_fare WHERE bus_type = $bus_type"));
  $payment_amount = $fareData['fare'];

  $contact_number = $_SESSION['contact_number'];
  $email_address = $_SESSION['email_address'];
  $valid_id = $_SESSION['valid_id'];
}

if(isset($_POST['add']) && $_POST['process']=="add_data"){
  $add_data = transaction($connection, $_POST, 2);
  $alert = alert_box('success', $add_data);
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
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </head>
    <!--INTERNAL CSS-->    
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        .container {
            padding: 30px;
            padding-top: 0;
            justify-content: center;
         }
        .form-container{
            display:flex;
            justify-content: center;
            align-items: center;
        } 
        .row-container{
            width: 50%;
            justify-content: center;
            align-items: center;

        }
        .row-content{
            margin: 5px;
            color: black;
            font-weight: 900;
        }
        .row1{
            padding: 15px; 
            /* border: 1px solid #fff; */
            border-radius: 10px;
            margin-bottom: 30px;
            background-color: white;
            opacity: 0.85;
            font-family: 'Poppins';
            box-shadow: 8px 11px 12px -6px rgba(0,0,0,0.75);
            -webkit-box-shadow: 8px 11px 12px -6px rgba(0,0,0,0.75);
            -moz-box-shadow: 8px 11px 12px -6px rgba(0,0,0,0.75);
            
            
        }
        .row2{
            /* border: 1px solid #fff; */
            border-radius: 10px;
            padding: 15px;
            background-color: white;
            opacity: 0.85;
            font-family: 'Poppins';
            box-shadow: 8px 11px 12px -6px rgba(0,0,0,0.75);
            -webkit-box-shadow: 8px 11px 12px -6px rgba(0,0,0,0.75);
            -moz-box-shadow: 8px 11px 12px -6px rgba(0,0,0,0.75);
        }
        .form-container button{
            border-radius: 10px;
            background-color: #198754;
            color: white;
            padding: 10px;
            margin: 10px;
            width: 100px;
            transition: 0.3s;
            justify-content: center;
            align-items: center;
        }
        .form-container button:hover{
          background-color: #02522c;
        }
        .footer {
        position: absolute;
        left: 0;
        width: 100%;
        color: white;
        text-align: center;
        }
    </style>

</head>
<body style="background-image: url('images/bg5.png'); background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-size: 100% 100%;">
    <nav class="navbar navbar-light bg-dark d-flex w-100 display-fixed">
        <div class="container-fluid">
            <a class="navbar-brand p-4 text-light" href="index.php">
                <img src="images/logo.png" alt="Logo" width="50" height="35" class="d-inline-block align-text-top ">
                AntoninaLine Bus Ticket System</a>
                <div class="login">
                    <span class="navbar-text p-2 text-light">
                    <form action = "" method="POST">
                        <input type='hidden' name='process' value='logout_user' />
                        <button type="submit" name='logout' class="btn btn-success">Logout</button>
                    </form>
                    </span>
                </div>
            </div>
    </nav>
    <form action = "" method="POST" enctype="multipart/form-data">
    <div class="container justify-content-center">
        <h1 style="font-weight: 900;"><?php echo $title; ?></h1>
        
        <?php 
        $payment_date = date("Y-m-d");
        echo "
        <input type='hidden' name='bus_id' value='$bus_id'>
        <input type='hidden' name='bus_routes_id' value='$bus_routes_id'>
        <input type='hidden' name='departure_time' value='$departure_time'>
        <input type='hidden' name='destination' value='$location'>
        <input type='hidden' name='passenger_count' value='$passenger_count'>
        <input type='hidden' name='bus_type' value='$bus_type'>
        <input type='hidden' name='payment_amount' value='$payment_amount'>
        <input type='hidden' id='total_payment_amount' name='total_payment_amount'>
        <input type='hidden' name='payment_date' value='$payment_date'>
        <input type='hidden' name='departure_date' value='$date'>
        "; 
        ?>
        <div class="form-container">
            <div class="col-md-12 justify-content-center row-container">
                    <div class="row1 justify-content-center w-100" >
                        <div class="row-content">
                            <label for="Contact-Number" class="col-md-3 form-lable">
                                Contact Number:
                            </label>
                            <?php
                            ?>
                            <?php 
                            echo "
                            <input value='$contact_number' readonly type='phoneNumber' class='form-control' id='contact_number' name='contact_number'
                            oninput='javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);' maxlength='11' required>
                            ";
                            ?>
                           
                        </div>
                        <div class="row-content">
                            <label for="Email" class="col-sm-3 form-label">
                                Email Address:
                            </label>
                            <?php
                            echo "
                            <input value='$email_address' readonly type='email' class='form-control' id='email' name='email' required>
                            
                            ";
                            ?>
                        </div>
                        <div class="row-content">
                            <label class="col-sm-3 form-label" for="customFile">Upload Receipt:</label>
                            <input type="file" class="form-control" name="imageData" id="imageData" required />
                            <?php
                            echo "
                            <button onClick='setDiscount($bus_type, $passenger_count, $payment_amount)' id='add' data-bs-toggle='modal' data-bs-target='#invoice' type='button' class='justify-content-center' style='width: 120px; height: 30px; padding: 0px;'>Fare</button>
                            ";
                            ?>
                            <input type="hidden" name="uploadReceiptData" id="uploadReceiptData" value="">
                        </div>
                    </div>
                <?php
                for($i=1; $i<=$passenger_count; $i++) {
                ?>
                    <div class="row2 w-100 mb-3">
                        <h5>Passenger 
                          <?php echo "#".$i; ?>
                        </h5>
                        <div class="row-content">
                            <label for="name" class="col-sm-3 form-lable">
                                Name:  
                            </label>
                            <?php echo 
                            "
                            <input type='text' class='form-control' id='name[$i]' name='name[$i]' 
                            placeholder='Enter your name' required>
                            ";
                            ?>
                        </div>
                        <div class="row-content">
                            <label for="age" class="col-sm-3 form-label">
                                Age:
                            </label>
                            <?php echo 
                            "
                            <input type='number' class='form-control' style='width: 80px;' 
                            maxlength='3' id='age[$i]' name='age[$i]' required>
                            ";
                            ?>
                        </div>
                        <?php
                        echo "
                        <div class='row-content'>
                            <label for='age' class='col-sm-2 form-label'>
                                Discount:
                            </label>
                            <select onChange='selectDiscountType($i, $bus_type, $passenger_count)' name='discountIDType[$i]' id='discountIDType[$i]'>
                              <option value='1'>N/A</option>
                              <option value='2'>Senior Citizen</option>
                              <option value='3'>Person With Disability</option>
                            </select>
                        </div>
                        <div id='showData[$i]' class='row-content' style='display: none;'>
                            <label for='age' class='col-sm-2 form-label'>
                                Upload ID:
                            </label>
                            <input type='file' class='form-control' name='discountImageData[$i]' id='discountImageData[$i]' />
                        </div>
                        ";
                        ?>
                        <div class="row-content">
                          <label for="age" class="col-sm-3 form-label">
                              Seat Number:
                          </label>
                        </div>
                        <?php 
                        echo "
                          <div class='row-content'>
                          <input type='text' class='form-control form-element-group-part' id='form-seat-number[$i]' data-bs-toggle='modal' data-bs-target='#choose-seat$i' name='sit_number[$i]' placeholder='Choose seats' readonly required>
                          </div>
                          ";
                          ?>
                        <?php
                        $sql = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM settings"));
                        $alert_level = $sql['alert_level'];

                        if($alert_level == 3) {
                        ?>
                        <div class="row-content">
                            <label class="col-sm-3 form-label" for="customFile">Vaccination Card:</label>
                            <?php
                            echo "
                            <input type='file' class='form-control' name='uploadVaccinationData[$i]' id='uploadVaccinationData[$i]' value=''>
                            ";
                            ?>
                        </div>
                        <?php 
                        } ?>
                    </div>
                    <!-- Sit Number -->
                    <?php
                    echo "
                  <div class='modal fade' id='choose-seat$i' tabindex='1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                  ";
                  ?>
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-6 p-2 text-center" id="exampleModalLabel">Choose your seats</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="seat-chart">
                          <div class="legend-box available"></div>
                          <div class="legend-description"> - Available</div>
                          <div class="legend-box unavailable"></div>
                          <div class="legend-description"> - Unavailable</div>
                          <div class="legend-box selected"></div>
                          <div class="legend-description"> - Selected</div>
                        </div>
                        <?php
                        
                        for($a=1; $a<=49; $a++) {
                          $sql[$a] = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM passenger_logs WHERE sit_number = $a AND departure_date='$date' AND departure_time='$departure_time' AND bus_id = '$bus_id'"));
                          $sit_check[$a] = $sql[$a]['sit_number'];

                          $alert_level_data = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM settings"));
                          $alert_level = $alert_level_data['alert_level'];
                          if($sit_check[$a] > 0 && $alert_level <=1) {
                            $unavailable[$a] = "unavailable";
                            $modal_close[$a] = "";
                            $getSeatNumber[$a] = "";
                          } else if($sit_check[$a] == 0 && $alert_level <=1){
                            $unavailable[$a] = "available";
                            $modal_close[$a] = "data-bs-dismiss='modal'";
                            $getSeatNumber[$a] = "";
                          }

                          if($sit_check[$a] > 0 && $alert_level >=2) {
                            $unavailable[$a] = "unavailable";
                            $modal_close[$a] = "";
                            $getSeatNumber[$a] = "";
                          } else if($sit_check[$a] == 0 && $alert_level >=2){
                            $unavailable[$a] = "available";
                            $modal_close[$a] = "data-bs-dismiss='modal'";
                            $getSeatNumber[$a] = "";

                            for($b = 0; $b<=50; $b++) {
                              if($b%2 == 0) {
                                $unavailable[$b] = "unavailable";
                              }
                            }
                          }
                        }
                          echo "
                          <div class='seat-chart-legend'>
                          <div class='seatmap'>
                              <div class='seatmap-row'>
                              <span class='seat $unavailable[1]' $modal_close[1] onClick='getSeatNumber($i, 1)'>1</span>
                              <span class='seat $unavailable[2]' $modal_close[2] onClick='getSeatNumber($i, 2)'>2</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[3]' $modal_close[3] onClick='getSeatNumber($i, 3)'>3</span>
                              <span class='seat $unavailable[4]' $modal_close[4] onClick='getSeatNumber($i, 4)'>4</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[5]' $modal_close[5] onClick='getSeatNumber($i, 5)'>5</span>
                              <span class='seat $unavailable[6]' $modal_close[6] onClick='getSeatNumber($i, 6)'>6</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[7]' $modal_close[7] onClick='getSeatNumber($i, 7)'>7</span>
                              <span class='seat $unavailable[8]' $modal_close[8] onClick='getSeatNumber($i, 8)'>8</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[9]' $modal_close[9] onClick='getSeatNumber($i, 9)'>9</span>
                              <span class='seat $unavailable[10]' $modal_close[10] onClick='getSeatNumber($i, 10)'>10</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[11]' $modal_close[11] onClick='getSeatNumber($i, 11)'>11</span>
                              <span class='seat $unavailable[12]' $modal_close[12] onClick='getSeatNumber($i, 12)'>12</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[13]' $modal_close[13] onClick='getSeatNumber($i, 13)'>13</span>
                              <span class='seat $unavailable[14]' $modal_close[14] onClick='getSeatNumber($i, 14)'>14</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[15]' $modal_close[15] onClick='getSeatNumber($i, 15)'>15</span>
                              <span class='seat $unavailable[16]' $modal_close[16] onClick='getSeatNumber($i, 16)'>16</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[17]' $modal_close[17] onClick='getSeatNumber($i, 17)'>17</span>
                              <span class='seat $unavailable[18]' $modal_close[18] onClick='getSeatNumber($i, 18)'>18</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[19]' $modal_close[19] onClick='getSeatNumber($i, 19)'>19</span>
                              <span class='seat $unavailable[20]' $modal_close[20] onClick='getSeatNumber($i, 20)'>20</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[21]'$modal_close[21] onClick='getSeatNumber($i, 21)'>21</span>
                              <span class='seat $unavailable[22]'$modal_close[22] onClick='getSeatNumber($i, 22)'>22</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[23]'$modal_close[23] onClick='getSeatNumber($i, 23)'>23</span>
                              <span class='seat $unavailable[24]'$modal_close[24] onClick='getSeatNumber($i, 24)'>24</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[25]'$modal_close[25] onClick='getSeatNumber($i, 25)'>25</span>
                              <span class='seat $unavailable[26]'$modal_close[26] onClick='getSeatNumber($i, 26)'>26</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[27]'$modal_close[27] onClick='getSeatNumber($i, 27)'>27</span>
                              <span class='seat $unavailable[28]'$modal_close[28] onClick='getSeatNumber($i, 28)'>28</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[29]'$modal_close[29] onClick='getSeatNumber($i, 29)'>29</span>
                              <span class='seat $unavailable[30]'$modal_close[30] onClick='getSeatNumber($i, 30)'>30</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[31]'$modal_close[31] onClick='getSeatNumber($i, 31)'>31</span>
                              <span class='seat $unavailable[32]'$modal_close[32] onClick='getSeatNumber($i, 32)'>32</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[33]'$modal_close[33] onClick='getSeatNumber($i, 33)'>33</span>
                              <span class='seat $unavailable[34]'$modal_close[34] onClick='getSeatNumber($i, 34)'>34</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[35]'$modal_close[35] onClick='getSeatNumber($i, 35)'>35</span>
                              <span class='seat $unavailable[36]'$modal_close[36] onClick='getSeatNumber($i, 36)'>36</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[37]'$modal_close[37] onClick='getSeatNumber($i, 37)'>37</span>
                              <span class='seat $unavailable[38]'$modal_close[38] onClick='getSeatNumber($i, 38)'>38</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[39]'$modal_close[39] onClick='getSeatNumber($i, 39)'>39</span>
                              <span class='seat $unavailable[40]'$modal_close[40] onClick='getSeatNumber($i, 40)'>40</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[41]'$modal_close[41] onClick='getSeatNumber($i, 41)'>41</span>
                              <span class='seat $unavailable[42]'$modal_close[42] onClick='getSeatNumber($i, 42)'>42</span>
                              <span class='seat'>&nbsp;</span>
                              <span class='seat $unavailable[43]'$modal_close[43] onClick='getSeatNumber($i, 43)'>43</span>
                              <span class='seat $unavailable[44]'$modal_close[44] onClick='getSeatNumber($i, 44)'>44</span>
                            </div>
                            <div class='seatmap-row'>
                              <span class='seat $unavailable[45]'$modal_close[45] onClick='getSeatNumber($i, 45)'>45</span>
                              <span class='seat $unavailable[46]'$modal_close[46] onClick='getSeatNumber($i, 46)'>46</span>
                              <span class='seat $unavailable[47]'$modal_close[47] onClick='getSeatNumber($i, 47)'>47</span>
                              <span class='seat $unavailable[48]'$modal_close[48] onClick='getSeatNumber($i, 48)'>48</span>
                              <span class='seat $unavailable[49]'$modal_close[49] onClick='getSeatNumber($i, 49)'>49</span>
                            </div>
                          </div>
                          </div>
                          ";
                        ?>
                      </div>
                    </div>
                  </div>
                  <?php 
                  
                } ?>
                <div align="center">
                <input type="hidden" name="process" value="add_data" />
                <button type="submit" name="add" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
      </div>

      

      <!-- Fare Modal -->
      <div class="modal fade" id="invoice" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6 p-2 text-center" id="exampleModalLabel">Total Breakdown</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="container">
              <div class="card " style="background-color: #f3f3f3; border: 1px solid black">
                  <div class="card-body mx-4">
                    <div class="container">
                      <div class="row">
                        <div class="col-sm-10">
                          <p>Fare</p>
                        </div>
                        <div class="col-sm-2">
                          <p class="float-end">
                            <?php
                              echo "₱$payment_amount";
                              ?>
                          </p>
                        </div>
                        <hr>
                      </div>
                      <div class="row">
                        <div class="col-sm-10">
                          <p>Discount</p>
                        </div>
                        <div class="col-sm-2">
                          <p class="float-end">
                            <?php
                              if($bus_type == 1) echo "₱<span id='discountData'> </span>";
                              else echo "₱<span id='discountData'> </span>";
                              ?>
                          </p>
                        </div>
                        <hr>
                      </div>
                      
                      <div class="row">
                        <div class="col-sm-10">
                          <p>Passenger Count</p>
                        </div>
                        <div class="col-sm-2">
                          <p class="float-end">
                          <?php echo "$passenger_count"; ?>
                          </p>
                        </div>
                        <hr style="border: 2px solid black;">
                      </div>
                      <div class="row text-black">
                        <div class="col-sm-12">
                          <p class="float-end fw-bold">
                              <?php

                              echo "Total <span id='discountDataTotal'> </span>";
                              ?>
                          </p>
                        </div>
                        <hr style="border: 2px solid black;">
                      </div>
                
                    </div>
                  </div>
                </div>
              
          </div>
          </div>
        </div>
      </div>
    </form>

      <div class="footer py-2 mt-1 bg-dark text-light">
        <p>Copyright 2022. AntoninaLine Bus System. All rights reserved</p>
      </div>

    <!-- JavaScript Bundle with Popper -->
  <script >
  
  var receipt = document.getElementById('uploadReceipt');
  receipt.addEventListener('change', handleReceiptFiles, false);

  function handleReceiptFiles(e) {
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');

    var img = new Image();

    img.onload = function() {
      ctx.drawImage(img, 0, 0);

      var base64 = canvas.toDataURL();
      document.getElementById('uploadReceiptData').value = base64;
      // console.log(base64)
    }
    
    img.src = URL.createObjectURL(e.target.files[0]);

  }

    var vaccination = document.getElementById('uploadVaccination[1]');
    // var vaccination = document.getElementById('uploadVaccination[2]');
    // var vaccination = document.getElementById('uploadVaccination[3]');
    // var vaccination = document.getElementById('uploadVaccination[4]');
    // var vaccination = document.getElementById('uploadVaccination[5]');
    vaccination.addEventListener('change', handleVaccinationFiles, false);
// console.log(vaccination)

  // function setData(i) {
  //     var vaccination = document.getElementById('uploadVaccination[1]');
  //     // vaccination.addEventListener('change', handleVaccinationFiles, false);
  //     handleVaccinationFiles(vaccination)
  //     // console.log(vaccination)
  //   }  

  function handleVaccinationFiles(e) {
    // console.log(e)
    var canvas = document.createElement('canvas');
    var ctx = canvas.getContext('2d');

    var img = new Image();
    console.log(img)
    img.onload = function() {
      ctx.drawImage(img, 0, 0);

      var base64 = canvas.toDataURL();
      document.getElementById('uploadVaccinationData[1]').value = base64;
      // document.getElementById('uploadVaccinationData[2]').value = base64;
      // document.getElementById('uploadVaccinationData[3]').value = base64;
      // document.getElementById('uploadVaccinationData[4]').value = base64;
      // document.getElementById('uploadVaccinationData[5]').value = base64;
      // console.log(base64)
    }
    
    img.src = URL.createObjectURL(e.target.files[0]);

  }

  function getSeatNumber(a, b) {
    var params = "form-seat-number[" + a + "]";
      document.getElementById(params).value = b;

  }

  function selectDiscountType(a, b, c) {
    var params = "discountIDType[" + a + "]";
    var params2 = "showData[" + a + "]";
    var selected = document.getElementById(params).value;
    if(selected == 1) {
      document.getElementById(params2).style.display = "none";
    } else {
      document.getElementById(params2).style.display = "block";
    }
  }

  function setDiscount(bus_type, count, payment_amount) {
    var total = 0;
    if(document.getElementById("discountIDType[1]").value > 1) {
      if(bus_type == 1) {
        var amount = payment_amount * 0.02
        total = amount
      } else {
        var amount = payment_amount * 0.02
        total = amount
      }
    }

    if(bus_type == 1) var amount1 = payment_amount
    else var amount1 = payment_amount
    var totalAmount = amount1 * count - total
    document.getElementById("discountData").innerHTML = total
    document.getElementById("discountDataTotal").innerHTML = totalAmount
    document.getElementById("total_payment_amount").value = totalAmount
  }


  </script>
</body>
</html>