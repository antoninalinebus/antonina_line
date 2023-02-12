<?php
include("db_functions.php");
if(isset($_POST['add']) && $_POST['process']=="add_user"){
    $add_user = add_user($connection, $_POST, 2);
}
if(isset($_POST['edit']) && $_POST['process']=="edit_user"){
    $edit_user = edit_user($connection, $_POST);
}
if(isset($_POST['delete']) && $_POST['process']=="delete_user"){
    $edit_user = delete_user($connection, $_POST);
}

?>
<html>
<body>
    <?php 
    // $data = mysqli_fetch_array(mysqli_query($connection, "SELECT MAX(id) as maxid FROM transaction_logs"));
    // $maxid = $data['maxid'];
    // echo $maxid;
    //   echo "<form action='' method='POST'>";
    // for($i=1; $i<=2; $i++){
    //     echo "
    //     <input type='text' name='username[$i]' value=''>
    //     <input type='text' name='password[$i]' value=''>
    //     <input type='hidden' name='process' value='add_user' />
        
    //     ";
    // }
    // echo "
    // <input type='submit' value='Add' name='add' class='btn btn-primary'>
    // </form>";
    ?>
    

<!-- ADD USER -->

    <form action="" method="POST"> 
    <input type="text" name="username" value="">
    <input type="text" name="password" value="">
    <input type="text" name="name" value="">
    <input type="text" name="contact_number" value="">
    <?php 
    $sql = mysqli_query($connection, "SELECT * FROM buses");
    echo "<select name='bus_id'>";
    while($data=mysqli_fetch_array($sql)) {
        echo "<option value='".$data['id']."'"; if($data['hasDriver']==1) echo "disabled"; echo ">".$data['name']."</option>";
    }
    echo "</select>"; 
    ?>
    <input type="file" id="picture" value="">
    <input type="hidden" name="pictureData" id="pictureData" value="">
    <input type="hidden" name="process" value="add_user" />
    <input type="submit" value="Add" name="add" class="btn btn-primary" >
    </form>

    <br> <br>
  
    <!-- <form action="" method="POST"> 
    <input type="text" name="id" value="">
    <input type="text" name="username" value="">
    <input type="text" name="password" value="">
    <input type="text" name="name" value="">
    <input type="text" name="contact_number" value="">
    <input type="hidden" name="process" value="edit_user" />
    <input type="submit" value="Update" name="edit" class="btn btn-primary" >
    </form>

    <br> <br>
    <form action="" method="POST">
    <input type="text" name="id" value="">
    <input type="text" name="bus_id" value="" />
    <input type="hidden" name="process" value="delete_user" />
    <input type="submit" value="Delete" name="delete" class="btn btn-primary" >
    </form> -->


</body>

<script>
var input = document.getElementById('picture');
input.addEventListener('change', handleFiles, false);

function handleFiles(e) {
  var canvas = document.createElement('canvas');
  var ctx = canvas.getContext('2d');

  var img = new Image();

  img.onload = function() {
    ctx.drawImage(img, 0, 0);

    var base64 = canvas.toDataURL();
    document.getElementById('pictureData').value = base64;
    console.log(base64)
  }
  
  img.src = URL.createObjectURL(e.target.files[0]);

}
</script>
</html>