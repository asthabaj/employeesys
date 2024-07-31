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
    header("location:index.php");
}

if (isset($_POST['save'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $dept = trim($_POST['dept_id']);

    // Check if dept_id exists in the department table
    $checkDept = "SELECT id FROM department WHERE id = '$dept'";
    $checkDeptResult = mysqli_query($con, $checkDept);

    if (mysqli_num_rows($checkDeptResult) == 0) {
        $_SESSION['status'] = 'Department ID does not exist';
        header("location:employeedata.php");
        exit();
    }

    $sql = "INSERT INTO employee (fname, lname, email, phone, address, dept_id) VALUES ('$fname', '$lname', '$email', '$phone', '$address', '$dept')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $_SESSION['status'] = 'Added Successfully';
        header("location:employeedata.php");
    } else {
        $_SESSION['status'] = 'Not Added: ' . mysqli_error($con);
        header("location:employeedata.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
    <link rel="stylesheet" href="addemployee.css">
</head>
<body>
<?php include "header.php"; ?>

<div class="container">
    <h2>Add Employee</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" required>
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" required>
        </div>
        <div class="form-group">
            <label for="dept_id">Department</label>
            <select name="dept_id" id="dept_id" required>
                <?php
                $dept_query = "SELECT id, dept_name FROM department";
                $dept_result = mysqli_query($con, $dept_query);

                while ($dept = mysqli_fetch_assoc($dept_result)) {
                    echo "<option value='{$dept['id']}'>{$dept['dept_name']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="save" class="btn-primary">Save</button>
        <a href="employeedata.php" class="btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
