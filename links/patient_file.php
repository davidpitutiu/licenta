<?php
  include '../login/connection.php';
	error_reporting(0);
  session_start();
  $puser_id = $_GET['puser_id'];
  $user_id = $_SESSION['user_id'];
  // echo $user_id;
  $sql = "SELECT firstname FROM users where user_id = '$user_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$firstname = $row['firstname'];
	}
  // echo $puser_id;
  $sql = "SELECT firstname, lastname FROM users WHERE user_id = '$puser_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($result)){
    $username = $row['lastname']. ' ';
    $username .= $row['firstname'];
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
  <title><?php echo $username; ?></title>
</head>
<body>
  <div class="navbar  navbar-expand-sm">
    <a class="nav-link" href="logout.php">Log Out</a>
    <a class="nav-link" href="settings.php">Settings</a>
    <a class="nav-link" href="profile.php"><?php echo $firstname ?></a>
    <a class="nav-link" href="home.php" >Home</a>
  </div>
  <div class="div-diagnostics">
    <h1 style = "color: #00dc00"><?php echo $username; ?></h1>
    <form action="" method="POST" class="login-email">
			<div class="input-group">
				<input type="text" placeholder="Diagnostic Name" name="dname" value="<?php echo $dname; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Diagnostic Description" name="ddescription" value="<?php echo $ddescription; ?>" required>
			</div>

			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
      </div>
		</form>
  </div>
</body>
</html>
