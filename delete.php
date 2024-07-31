<?php
session_start();
include "functions.php";
if (!isset($_SESSION['userid'])) {
    header('Location: index.php');
    exit;
}
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    $sql = "SELECT * FROM user WHERE id = '$userid'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($con);
        exit;
    }
}

if (isset($_GET['id'])) {
    $empid = $_GET['id'];
    $sql1 = "SELECT * FROM employee WHERE id = '$empid'";
    $result1 = mysqli_query($con, $sql1);
    if ($result1 && mysqli_num_rows($result1) > 0) {
        $employee = mysqli_fetch_assoc($result1);
    } else {
        echo "Employee not found.";
        exit;
    }
} else {
    echo "Invalid employee ID.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $empid = $_POST['empid'];
    $sql = "UPDATE `employee` SET `deleted_at` = NOW() WHERE id = '$empid'";
    $sql2 = "UPDATE `user` SET `deleted_at` = NOW() WHERE id = '$userid'";
    
    if (mysqli_query($con, $sql) && mysqli_query($con, $sql2)) {
        $_SESSION['status'] = "Employee deleted successfully.";
    } else {
        $_SESSION['status'] = "Error deleting employee.";
    }
    header('Location: employeedata.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="delete.css">

    <title>Delete Employee</title>
</head>
<body>
    <!-- Employee Modal -->
    <div class="modal" tabindex="-1" role="dialog" style="display: block;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <span class="close" onclick="closeModal()">&times;</span>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <?php echo htmlspecialchars($employee['fname']) . " " . htmlspecialchars($employee['lname']); ?>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-secondary" onclick="window.location.href='employeedata.php'">Close</button>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="empid" value="<?php echo htmlspecialchars($employee['id']); ?>">
                        <button type="submit" class="btn-primary">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeModal() {
            document.querySelector('.modal').style.display = 'none';
            window.location.href = 'employeedata.php';
        }
    </script>
</body>
</html>
