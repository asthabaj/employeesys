<?php
include "connect.php";

// Check if the function is already defined before declaring it
if (!function_exists('isAuth')) {
    function isAuth()
    {
        if (isset($_SESSION['userid'])) {
            return $_SESSION['userid'];
        } else {
            header("location: index.php");
            exit;
        }
    }
}

$sql1 = "SELECT * FROM employee";
$result1 = mysqli_query($con, $sql1);
if ($result1) {
    $employee = mysqli_fetch_assoc($result1);
    //echo var_dump($employee);
} else {
    echo "Error: " . mysqli_error($con);
}

$deptid = $employee["dept_id"];
$sql2 = "SELECT * FROM department WHERE id = '$deptid'";

$result2 = mysqli_query($con, $sql2);
if ($result2) {
    $dept = mysqli_fetch_assoc($result2);
    //echo var_dump($dept);
} else {
    echo "Error: " . mysqli_error($con);
}
?>
