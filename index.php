<?php
include "functions.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="index.css"> 

    <title>Login</title>
</head>
<body>
  
<section class="full-height">
    <div class="container">
        <div class="center-content">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-5">Log In!</h3>
                    <form action="loginprocess.php" method="POST">
                        <div class="form-group">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" class="form-control" name="username"/>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" class="form-control" name="password" />
                        </div>
                        <div class="button-group">
                            <button class="btn-primary" type="submit">Login</button>
                            <a href="register.php" class="btn-secondary">Register</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
