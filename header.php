<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="header.css" />
    <title>Document</title>
  </head>
  <body>
    <div class="container">
      <nav class="navbar">
        <a class="navbar-brand" href="#">EmpSyS</a>
        <a class="nav-link" href="dashboard.php">Dashboard</a>
        <a class="nav-link" href="employeedata.php">Employees</a>
        <a class="nav-link" href="profile.php">Profile</a>
        <form class="logout-form" action="logout.php" method="post">
          <button type="submit" class="logout-button" name="logout">Logout</button>
        </form>
      </nav>
    </div>
  </body>
</html>
