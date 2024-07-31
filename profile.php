<?php
include "connect.php";
session_start();

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
    header("location:index.php");
    exit;
}

$sql1 = "SELECT * FROM employee WHERE id = '$userid'";
$result1 = mysqli_query($con, $sql1);

if ($result1) {
    $employee = mysqli_fetch_assoc($result1);
} else {
    echo "Error: " . mysqli_error($con);
}

$deptid = $employee["dept_id"];
$sql2 = "SELECT * FROM department WHERE id = '$deptid'";
$result2 = mysqli_query($con, $sql2);

if ($result2) {
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
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css"> 
</head>
<body>
<?php include "header.php"; ?>
<h1 class="profile-title">User Profile</h1>

<table class="profile-table">
    <thead>
        <tr>
            <td colspan="2" class="profile-header">
                <?php echo htmlspecialchars($employee['fname']) . " " . htmlspecialchars($employee['lname']); ?>
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="profile-label">Email</td>
            <td class="profile-data"><?php echo htmlspecialchars($employee['email']); ?></td>
        </tr>
        <tr>
            <td class="profile-label">Phone</td>
            <td class="profile-data"><?php echo htmlspecialchars($employee['phone']); ?></td>
        </tr>
        <tr>
            <td class="profile-label">Address</td>
            <td class="profile-data"><?php echo htmlspecialchars($employee['address']); ?></td>
        </tr>
        <tr>
            <td class="profile-label">Department</td>
            <td class="profile-data"><?php echo htmlspecialchars($dept['dept_name']); ?></td>
        </tr>
    </tbody>
</table>
</body>
</html>
