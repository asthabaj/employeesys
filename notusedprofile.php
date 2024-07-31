<?php
session_start();
include "functions.php";

if(isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];

    $sql = "SELECT * FROM user WHERE id = '$userid'";
    $result = mysqli_query($con, $sql);

    if($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    
    echo "Error: userid not set in session";
    header("location:index.php");
}


$sql1 ="select * from employee";
//where user_id = '$userid'";
$result1 = mysqli_query($con, $sql1);
if($result1) {
    $employee = mysqli_fetch_assoc($result1);
    //echo var_dump($employee);
} else {
    echo "Error: " . mysqli_error($con);
}
$deptid = $employee["dept_id"];
$sql2 ="select * from department where id = '$deptid'";

$result2 = mysqli_query($con, $sql2);
if($result2) {
    $dept = mysqli_fetch_assoc($result2);
    //echo var_dump($dept);
} else {
    echo "Error: " . mysqli_error($con);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <!-- Bootstrap CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>
<?Php
    include "header.php";
    ?>
    <h1 style="text-align:center; text-decoration: underline">
        User Profile
    </h1>
  
    
    
    <table class="table table-bordered " style="border-width:4px; margin-left: 150px; margin-top:50px;  width:1200px;">
  <thead style="border-width:4px;">
    <tr>
   
    <td colspan="2" style="text-align: center; font-weight:bold; font-size:24px"><?php
    echo $employee['fname'] ."    ". $employee['lname'];
?></td>
     
    </tr>
  </thead>
  <tbody style="border-width:4px;">
   
    <tr >
    <td style="font-weight: bold; border-width:4px;">
        Email
        </td>
      <td style="border-width:4px;"><?php
        echo $employee['email'];
        ?></td>
    </tr>
    <tr>
    <td style="font-weight: bold; border-width:4px;">
         Phone
        </td>
      <td style="border-width:4px;"><?php
        echo $employee['phone'];
        ?></td>
    </tr>
    <tr>
    <td style="font-weight: bold; border-width:4px;">
        Address
        </td>
      <td style="border-width:4px; border-width:4px;"><?php
        echo $employee['address'];
        ?></td>
    </tr>
    <tr>
    <td style="font-weight: bold; border-width:4px;">
        Department
        </td>
      <td style="border-width:4px;"><?php
        echo $dept['dept_name'];
        ?></td>
    </tr>
  </tbody>
</table>

    
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>
</html>