<?php 
 $dbhost = "sql12.freesqldatabase.com";
 $dbuser = "sql12597734";
 $dbpass = "HR7qlx2QeL";
 $dbname = "sql12597734";
//  $dbhost = "localhost";
//  $dbuser = "root";
//  $dbpass = "";
//  $dbname = "antonina_line";

 $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
// if(isset($connection)) {
//     echo "true";
// } else {
//     echo "not true";
// }


    // $up_msg = $obj->add_user();

 
//  if(isset($_POST['action'])){
//     if($_POST['action']=='load_allorder'){
//         $date = $_POST['did'];


//         $dayquery = "SELECT * FROM `all_order_info` WHERE `order_date` BETWEEN '$date' and CURDATE();";

       
//        $row = mysqli_query($connection, $dayquery);
//        $result = mysqli_num_rows($row);
//        echo $result;

//     }
// }
?>