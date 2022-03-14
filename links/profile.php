<?php
  include '../login/connection.php';
	error_reporting(0);
  session_start();
  $user_id = $_SESSION['user_id'];
  $sql = "SELECT firstname FROM users where user_id = '$user_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$firstname = $row['firstname'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <title><?php echo $firstname?></title>
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="home.php">Home</a>
    <a class="navbar-brand" href="profile.php"><?php echo $firstname; ?></a>
    <a class="navbar-brand" href="settings.php">Settings</a>
    <a class="navbar-brand" href="logout.php">Log Out</a>
  </nav>
</body>
</html>
