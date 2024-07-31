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

// Check if the ID is passed in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // SQL query to fetch employee details based on the ID
    $sql = "SELECT * FROM employee WHERE id = $id AND deleted_at IS NULL";
    $result = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        $employee = mysqli_fetch_assoc($result);
    } else {
        echo "Employee not found.";
        exit;
    }
} else {
    echo "Invalid ID.";
    exit;
}
$deptid = $employee["dept_id"];
$sql2 ="select * from department where id = '$deptid'";

$result2 = mysqli_query($con, $sql2);
if($result2) {
    $dept = mysqli_fetch_assoc($result2);
} else {
    echo "Error: " . mysqli_error($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Employee</title>
    <link rel="stylesheet" href="styles.css"> <!-- Add your custom CSS file -->
</head>
<body>
<?php include "header.php"; ?>
<div class="container">
    <h2>Employee Details</h2>
    <table class="details-table">
        <tr>
            <th>ID</th>
            <td><?php echo htmlspecialchars($employee['id']); ?></td>
        </tr>
        <tr>
            <th>First Name</th>
            <td><?php echo htmlspecialchars($employee['fname']); ?></td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td><?php echo htmlspecialchars($employee['lname']); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($employee['email']); ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?php echo htmlspecialchars($employee['phone']); ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo htmlspecialchars($employee['address']); ?></td>
        </tr>
        <tr>
            <th>Department</th>
            <td><?php echo htmlspecialchars($dept['dept_name']); ?></td>
        </tr>
    </table>
    <a href="employeedata.php" class="back-button">Back to Employee List</a>
</div>
</body>
</html>
