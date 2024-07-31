<?php
session_start();
include "functions.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = $_POST["username"];
    $password = $_POST["password"]; 
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' AND deleted_at IS NULL";

    $result = mysqli_query($con,$sql);

    $users = mysqli_fetch_assoc($result);
    //echo var_dump($result);
    $row = mysqli_num_rows($result);
    if($users){
        $_SESSION['userid'] = $users['id'];
        
        echo "Logged in";
        header('location: dashboard.php');
        $sql = "UPDATE user SET login_time = NOW()";

        if (mysqli_query($con, $sql)) {
            echo "Login time updated successfully";
            
    }
}
    else    
    {
        echo "User not found";
    }
}
?>