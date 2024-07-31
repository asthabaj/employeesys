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

$sql1 = "SELECT * FROM employee WHERE deleted_at IS NULL";
$result1 = mysqli_query($con, $sql1);
if ($result1) {
    $employee = mysqli_fetch_assoc($result1);
} else {
    echo "Error: " . mysqli_error($con);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="employeedata.css">

    <title>Employee List</title>
</head>
<body>
<?php include "header.php"; ?>

<div class="modal" id="employeemodal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add employee</h5>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form action="addemployee.php" method="POST">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" name="phone" id="phone">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                    <div class="form-group">
                        <label for="dept_name">Department</label>
                        <select name="dept_name" id="dept_name" class="form-control" required>
                            <option value="">Select Department</option>
                            <?php
                            $sql2 = "SELECT * FROM department";
                            $result2 = mysqli_query($con, $sql2);
                            if ($result2) {
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    echo "<option value='{$row['id']}'>{$row['dept_name']}</option>";
                                }
                            } else {
                                echo "Error: " . mysqli_error($con);
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="dept_id" id="dept_id">
                    <div class="modal-footer">
                        <button type="button" class="btn-secondary" onclick="closeModal()">Close</button>
                        <button type="submit" name="save" class="btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="card">
        <?php
        if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
            echo $_SESSION['status'];
            unset($_SESSION['status']);
        }
        ?>
        <div class="card-header">
            <h1>Employee List
                <button type="button" class="btn-primary float-right" onclick="openModal()">Add New Employee</button>
            </h1>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Department</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT emp.id, emp.fname, emp.lname, dep.dept_name FROM employee AS emp LEFT JOIN department AS dep ON dep.id = emp.dept_id WHERE emp.deleted_at IS NULL";
                    $result = mysqli_query($con, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['fname']}</td>
                                    <td>{$row['lname']}</td>
                                    <td>{$row['dept_name']}</td>
                                    <td>
                                        <a href='view.php?id={$row['id']}' class='badge badge-primary'>VIEW</a>
                                        <a href='edit.php?id={$row['id']}' class='badge badge-info'>EDIT</a>
                                        <a href='delete.php?id={$row['id']}' class='badge badge-danger'>DELETE</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('employeemodal').style.display = 'block';
    }

    function closeModal() {
        document.getElementById('employeemodal').style.display = 'none';
    }

    document.getElementById('dept_name').addEventListener('change', function () {
        var selectedDeptId = this.value;
        document.getElementById('dept_id').value = selectedDeptId;
    });
</script>

</body>
</html>
