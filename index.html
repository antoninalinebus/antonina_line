<?php
include("functions/db_functions.php");
error_reporting(0);  
session_start();

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
        <link rel="stylesheet" href="css/theme.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </head>
    <style> 
    .bg-container{
      /* background: url(images/b1.jpg); */
      background-size: cover;
      position: relative;
      min-height: 500px;
      border: 5px #198754;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

   .pick_trips{
      padding: 10px;
      align-items: center;
      text-align: center;
      
    }
   .pick_trips button{
      padding: 10px;
      width: 200px;
      margin-top: 10px;
      font-size: 20px;
      font-weight: 600;
      color: white;
      background-color: #198754;
      border: none;
      outline: none;
      border-radius: 30px;
    }
    .pick_trips button:hover{
      font-weight: 700;
      background: rgb(25,135,84);
      background: linear-gradient(162deg, rgba(25,135,84,1) 0%, rgba(37,35,35,1) 100%);
    }
    .footer1 {
      position: absolute;
      left: 0;
      width: 100%;
      color: white;
      text-align: center;
    }             
        
    
    </style>
    <body>

    <!-- ALERT LEVEL ANNOUNCEMENT -->
    <div id="alert" class="alert text-bg-success alert-dismissible fade show d-flex align-items-center justify-content-center" role="alert">
              <?php
              $d = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM settings"));
              $alert_level = $d['alert_level'];

              echo "
              We are on the Alert LEVEL $alert_level
              ";
              ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

      <!-- NAVBAR -->
      <nav class="navbar navbar-light bg-dark  d-flex w-100">
        <div class="container">
            <a class="navbar-brand p-4 text-light" href="index.php">
                <img src="images/logo1.png" alt="Logo" width="50" height="35" class="d-inline-block align-text-top ">
                AntoninaLine Bus Ticket System</a>
                <div class="login">
                    <span class="navbar-text p-2 text-light">
                      <?php
                      if($_SESSION['role'] >= 1){
                        echo "
                        <form action = '' method='POST'>
                        <input type='hidden' name='process' value='logout_user' />
                        <button type='submit' name='logout' class='btn btn-success'>Logout</button>
                        </form>
                        ";
                      } else {
                        echo "
                        <a href='login.php'><button type='button' class='btn btn-success'><i class='fa-regular fa-circle-user'></i> Login</button></a>
                        <a href='register.php'><button type='button' class='btn btn-success'><i class='fa-regular fa-circle-user'></i> Register</button></a>
                        ";
                      }  
                      ?>
                        
                    </span>
                </div>
            </div>
      </nav>
      <!-- header -->

      <div class="bg-container">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
              <img src="images/b1.png" class="d-block w-100" height="550" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="2000">
              <img src="images/bg5.png" class="d-block w-100" height="550" alt="...">
            </div>
            <div class="carousel-item">
              <img src="images/bg3.png" class="d-block w-100" height="550" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

      <div class="pick_trips">
        <button id="add" data-bs-toggle="modal" data-bs-target="#pickAtrips" type="button">Pick your Trips</button>
      </div>

      <div class="covid-safety">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="10000">
                <div class="covid-content">
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/sanitize.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Sanitize your hand</h3>
                      </div>
                    </div>
                  </div>
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/wash-hand.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Always wash your hand</h3>
                      </div>
                    </div>
                  </div>
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/wear-mask.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Always wear your mask</h3>
                      </div>
                    </div>
                  </div>
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/follow-sdistance.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Follow social distancing</h3>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="covid-content">
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/sanitize.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Sanitize your hand</h3>
                      </div>
                    </div>
                  </div>
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/wash-hand.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Always wash your hand</h3>
                      </div>
                    </div>
                  </div>
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/wear-mask.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Always wear your mask</h3>
                      </div>
                    </div>
                  </div>
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/follow-sdistance.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Follow social distancing</h3>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="covid-content">
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/sanitize.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Sanitize your hand</h3>
                      </div>
                    </div>
                  </div>
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/wash-hand.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Always wash your hand</h3>
                      </div>
                    </div>
                  </div>
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/wear-mask.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Always wear your mask</h3>
                      </div>
                    </div>
                  </div>
                  <div class="covid-content-card">
                    <div class="card" style="width: 18rem;">
                      <img src="images/covid-safety/follow-sdistance.jpg" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h3>Follow social distancing</h3>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
           
            
          </div>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>

        <div class="modal fade" id="pickAtrips" tabindex="1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-6 p-2" id="exampleModalLabel">Pick your trips</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="container">
                <div class="div-container">
                  <?php
                  $sql = mysqli_query($connection, "SELECT buses.*, bus_routes.location1, bus_routes.location2, bus_routes.colour, bus_fare.fare 
                  FROM buses 
                  JOIN bus_fare ON bus_fare.bus_type = buses.bus_type
                  LEFT JOIN bus_routes ON bus_routes.id = buses.bus_routes_id
                  ");
                  while($data=mysqli_fetch_array($sql)) {
                  $bus_id=$data['id'];
                  $bus_routes_id=$data['bus_routes_id'];
                  $location1=$data['location1'];
                  $location2=$data['location2'];
                  $colour=$data['colour'];
                  $bus_type = $data['bus_type'];
                  if($bus_type == 1) {
                    $bus_type_name = "Ordinary";
                    $fare_price = $data['fare'];
                  }
                  else {
                    $bus_type_name = "Aircon";
                    $fare_price = $data['fare'];
                  }

                  // $bus = mysqli_fetch_array(mysqli_query($connection, "SELECT * FROM buses WHERE bus_routes_id = $bus_routes_id"));
                  // $bus_data = $bus['id'];
                  echo "
                  <div class='content'>
                    <div class='box-content md-5'>
                        <button id='add' data-bs-toggle='modal' data-bs-target='#calendar' onClick=\"calendar('$location1 - $location2', '$bus_id', '$bus_type', '$bus_routes_id', '8:00AM')\" style='background-color: #$colour;'>
                          <h4>$location1 - $location2</h4>
                          <h5>($bus_type_name - ₱$fare_price)</h5>
                        </button>
                      
                        <div class='right'>
                          <h4>DAILY TRIPS  (08:00AM)</h4>
                        </div>
                    </div>
                    <div class='box-content'>
                      <button id='add' data-bs-toggle='modal' data-bs-target='#calendar' onClick=\"calendar('$location2 - $location1', '$bus_id', '$bus_type', '$bus_routes_id', '8:00PM')\" style='background-color: #$colour;'>
                        <h4>$location2 - $location1</h4>
                        <h5>($bus_type_name - ₱$fare_price)</h5>
                    </button>
                      <div class='right'>
                        <h4>DAILY TRIPS (08:00PM)</h4>
                      </div>
                    </div>
                  </div>
                  ";
                  }
                  ?>
                  </div>
                </div>
              </div>
            </div>
            </div>
      </div>

      <!-- Modal Selection of calendar -->
      <div class="modal fade" id="calendar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-6 p-2" id="exampleModalLabel">Select your Schedule</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="forms.php">
              <div class="modal-body">
                <div class="modal-body">
                  <div class="md-form">
                   <!-- <i class="fas fa-envelope prefix grey-text"></i> -->
                    <label data-error="wrong" data-success="right" for="form">Date</label>
                    <input type="date" id="date" name="date" class="form-control validate" required>
                    <input type="hidden" name="process" value="fromIndex">
                    <input type="hidden" id="calendarTrips" name="trips">
                    <input type="hidden" id="bus_id" name="bus_id">
                    <input type="hidden" id="bus_type" name="bus_type">
                    <input type="hidden" id="bus_routes_id" name="bus_routes_id">
                    <input type="hidden" id="departure_time" name="departure_time">
                  </div> 
                  <div class="mb-3">
                    <label for="Contact-Number" class="form-label">
                        <div class="passengers">
                            How many passengers?
                        </div>
                    </label>
                    <input type="number" name="passenger_count" class="form-control" id="Contact-Number" placeholder="number of passengers" maxlength="11" required>
                </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
            
          </div>
        </div>
      </div>

      <section class="bg-white">
        <div class="container">
            <div class="row align-items-end mb-md-8 mb-4">
                <div class="col-md-auto">
                    <a href="#" class="d-flex align-items-center fw-medium">
                        Browse All
                        <div class="ms-2 d-flex">
                            <!-- Icon -->
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.7779 4.6098L3.32777 0.159755C3.22485 0.0567475 3.08745 0 2.94095 0C2.79445 0 2.65705 0.0567475 2.55412 0.159755L2.2264 0.487394C2.01315 0.700889 2.01315 1.04788 2.2264 1.26105L5.96328 4.99793L2.22225 8.73895C2.11933 8.84196 2.0625 8.97928 2.0625 9.1257C2.0625 9.27228 2.11933 9.4096 2.22225 9.51269L2.54998 9.84025C2.65298 9.94325 2.7903 10 2.9368 10C3.0833 10 3.2207 9.94325 3.32363 9.84025L7.7779 5.38614C7.88107 5.2828 7.93774 5.14484 7.93741 4.99817C7.93774 4.85094 7.88107 4.71305 7.7779 4.6098Z" fill="currentColor"></path>
                            </svg>

                        </div>
                    </a>
                </div>
            </div>

            <div class="row row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
                <div class="col-md mb-md-6 mb-4 px-2">
                    <!-- Card -->
                    <a href="#" class="card card-border-hover border icon-category icon-category-sm p-5 lift shadow-dark-hover">
                        <!-- Image -->
                        <div class="row align-items-center mx-n3">
                            <div class="col-auto px-3">
                                <div class="icon-h-p success">
                                  <i class="fa-solid fa-location-dot"></i>
                                </div>
                            </div>

                            <div class="col px-3">
                                <!-- Body -->
                                <div class="card-body p-0">
                                    <h6 class="mb-0 line-clamp-1">Routes</h6>
                                    <p class="mb-0 line-clamp-1">6</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md mb-md-6 mb-4 px-2">
                    <!-- Card -->
                    <a href="#" class="card card-border-hover border icon-category icon-category-sm p-5 lift shadow-dark-hover">
                        <!-- Image -->
                        <div class="row align-items-center mx-n3">
                            <div class="col-auto px-3">
                                <div class="icon-h-p secondary">
                                  <i class="fa-solid fa-bus"></i>
                                </div>
                            </div>

                            <div class="col px-3">
                                <!-- Body -->
                                <div class="card-body p-0">
                                    <h6 class="mb-0 line-clamp-1">Buses</h6>
                                    <p class="mb-0 line-clamp-1">10</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md mb-md-6 mb-4 px-2">
                    <!-- Card -->
                    <a href="#" class="card card-border-hover border icon-category icon-category-sm p-5 lift shadow-dark-hover">
                        <!-- Image -->
                        <div class="row align-items-center mx-n3">
                            <div class="col-auto px-3">
                                <div class="icon-h-p secondary">
                                  <i class="fa-solid fa-calendar-days"></i>
                                </div>
                            </div>

                            <div class="col px-3">
                                <!-- Body -->
                                <div class="card-body p-0">
                                    <h6 class="mb-0 line-clamp-1">Calendar Schedule</h6>
                                    <p class="mb-0 line-clamp-1"></p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md mb-md-6 mb-4 px-2">
                    <!-- Card -->
                    <a href="#" class="card card-border-hover border icon-category icon-category-sm p-5 lift shadow-dark-hover">
                        <!-- Image -->
                        <div class="row align-items-center mx-n3">
                            <div class="col-auto px-3">
                                <div class="icon-h-p secondary">
                                  <i class="fa-solid fa-ban"></i>
                                </div>
                            </div>

                            <div class="col px-3">
                                <!-- Body -->
                                <div class="card-body p-0">
                                    <h6 class="mb-0 line-clamp-1">Prohibited Items</h6>
                                    <p class="mb-0 line-clamp-1">must be followed</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                
            </div>
        </div>
      </section>

      <div class="container">
      <div class="div-container">
          <div class="row mt-5 mb-5">
              <div class="col-md-6">
                  <div class="card card-body block">
                      <h5 class="text-center mb-3">AntoninaLine Bus Popular Roads</h5>
                      <ul class="row">
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-location-dot" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;">Polangui-Pitx</a>
                          </li>
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-location-dot" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;">Legazpi-Pitx</a>
                          </li>
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-location-dot" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;">Tabaco-Pitx</a>
                          </li>
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-location-dot" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;">Pitx-Polangui</a>
                          </li>
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-location-dot" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;">Pitx-Legazpi</a>
                          </li>
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-location-dot" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;">Pitx-Tabaco</a>
                          </li>
                      </ul>
                  </div>
              </div>
              <div class="col-md-6 p-2">
                  <div class="card card-body block">
                      <h5 class="text-center mb-3">Why Book a Schedule from us?</h5>
                      <ul class="row">
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-check text-center" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;"><strong>Buy bus Tickets</strong> anytime from anywhere</a>
                          </li>
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-check text-center" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;">Safe to travel</a>
                          </li>
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-check" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;">Easy to access the website</a>
                          </li>
                          <li class="col-md-6 p-2">
                              <i aria-hidden="true" class="fa-solid fa-check" style="color:#198754; font-size: 17px;"></i>
                              <a href="#" style="color: #333333;"> easy to book with us</a>
                        
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      </div>

      <!-- Footer -->
      <footer class="bg-dark">
        <div class="footer-content">
            <h3 class="text-light">Antonina Line Bus Booking System</h3>
            <p>
              Antonina Line is a Philippines’s 
              greatest online bus ticketing platform that has transformed bus travel in the country by bringing ease and convenience to thousands of Filipinos who travel using buses. Founded in 2006, Antonina Line is part of Philippines’s leading online travel company, the Higer Bus Company, Ltd.. By providing widest choice, superior customer service, lowest prices and unmatched benefits, Antonina Line has served over 1.5 million customers. Antonina Line has 
              a national presence with operations across Bicol to Manila vice-versa. 
            </p>
            <ul class="socials">
                <li><a href="https://www.facebook.com/antoninaline.ph"><i class="fa fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/antoninaline.ph"><i class="fa fa-twitter"></i></a></li>
                <li><a href="www.google.com/antoninaline.ph"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
            </ul>
        </div>
      </footer>

      
      
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" 
    crossorigin="anonymous"></script>
    <script language="Javascript" type="application/javascript" xml:space="preserve">
      function calendar(a, b, c, d, e) {
        var trips = a;
        var id = b;
        var bus_type = c;
        var bus_routes_id = d;
        var departure_time = e;
        document.getElementById("calendarTrips").value = trips;
        document.getElementById("bus_id").value = b;
        document.getElementById("bus_type").value = c;
        document.getElementById("bus_routes_id").value = d;
        document.getElementById("departure_time").value = e;
      }
      
      document.getElementById("date").min = new Date().getFullYear() + "-" +  parseInt(new Date().getMonth() + 1 ) + "-" + new Date().getDate()
    </script>
    </body>
    
</html>
