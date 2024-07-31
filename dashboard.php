<?php
session_start();
include "functions.php";

if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];

    $sql = "SELECT * FROM user WHERE id = '$userid'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Error: userid not set in session";
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css"> 
  </head>
  <body>
    <?php include "header.php"; ?>
    <div class="container">
        <div class="card">
            <?php
            if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                echo $_SESSION['status'];
                unset($_SESSION['status']);
            }
            ?>
            <div class="card-header">
                <h1>Dashboard</h1>
            </div>
            <div class="card-body">
                <div class="stats-container">
                    <div class="stats-card">
                        <h1>Employee Count</h1>
                        <h2>
                            <?php
                            $sql1 = "SELECT * FROM employee WHERE deleted_at IS NULL";
                            $result1 = mysqli_query($con, $sql1);
                            if ($result1) {
                                $employee = mysqli_fetch_assoc($result1);
                                //echo var_dump($employee);
                            } else {
                                echo "Error: " . mysqli_error($con);
                            }
                            echo "(" . mysqli_num_rows($result1) . ")";
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  </body>
</html>
