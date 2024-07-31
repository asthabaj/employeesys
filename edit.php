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

if (isset($_GET['id'])) {
    $employee_id = $_GET['id'];

    $sql = "SELECT * FROM employee WHERE id = $employee_id";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        $employee = mysqli_fetch_assoc($result);
    } else {
        echo "Employee not found.";
    }
}

if (isset($_POST['update'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $dept_id = $_POST['dept_id'];

    $update_sql = "UPDATE employee SET fname='$fname', lname='$lname', email='$email', phone='$phone', address='$address', dept_id='$dept_id' WHERE id=$employee_id";
    $update_result = mysqli_query($con, $update_sql);
    $sql = "UPDATE `employee` SET `updated_at` = NOW() WHERE id = '$employee_id'";
    mysqli_query($con, $sql);

    if ($update_result) {
        $_SESSION['status'] = 'Employee details updated successfully.';
        header("Location: employeedata.php");
        exit;
    } else {
        echo "Error updating employee details: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="edit.css">
</head>
<body>
<?php include "header.php"; ?>

<div class="container">
    <h2>Edit Employee</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="fname">First Name</label>
            <input type="text" name="fname" id="fname" value="<?php echo $employee['fname']; ?>" required>
        </div>
        <div class="form-group">
            <label for="lname">Last Name</label>
            <input type="text" name="lname" id="lname" value="<?php echo $employee['lname']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?php echo $employee['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="<?php echo $employee['phone']; ?>" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" value="<?php echo $employee['address']; ?>" required>
        </div>
        <div class="form-group">
            <label for="dept_id">Department</label>
            <select name="dept_id" id="dept_id" required>
                <?php
                $dept_query = "SELECT id, dept_name FROM department";
                $dept_result = mysqli_query($con, $dept_query);

                while ($dept = mysqli_fetch_assoc($dept_result)) {
                    $selected = ($dept['id'] == $employee['dept_id']) ? 'selected' : '';
                    echo "<option value='{$dept['id']}' $selected>{$dept['dept_name']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" name="update" class="btn-primary">Update</button>
        <a href="employeedata.php" class="btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
