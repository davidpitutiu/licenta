<?php
  include '../login/connection.php';
	error_reporting(0);
  session_start();
  $user_id = $_SESSION['user_id'];
  // echo $user_id;
  $sql = "SELECT firstname FROM users where user_id = '$user_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$firstname = $row['firstname'];
  }
  if (isset($_POST['submit'])) {
    $phone = $_POST['phone'];
    $sql = "SELECT doctor_id FROM doctors WHERE user_id = '$user_id'";
    $result = mysqli_query($connect, $sql);
    $doctor = mysqli_query($connect, $sql);
    while ($row = $doctor->fetch_assoc()) {
      $doctor_id = $row['doctor_id'];
    }
    if($phone != 0){
      if($doctor_id){
        $sql = "UPDATE doctors SET phone_number = '$phone' WHERE user_id = '$user_id'";
        $result = mysqli_query($connect, $sql);
        $phone = "";
      }else{
        $sql = "UPDATE patients SET phone_number = '$phone' WHERE user_id = '$user_id'";
        $result = mysqli_query($connect, $sql);
        $phone = "";
      }
    }
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
  <title>Settings</title>
</head>
<body>
  <header>
    <div class="navbar  navbar-expand-sm">
      <a class="nav-link" href="logout.php">Log Out</a>
      <a class="nav-link" href="settings.php">Settings</a>
      <a class="nav-link" href="profile.php"><?php echo $firstname ?></a>
      <a class="nav-link" href="home.php" >Home</a>
    </div>
  </header>
  <div class="container">
		<form action="" method="POST" class="settings">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Settings</p>
			<div class="input-group">
        <input type="tel" placeholder="Enter your phone number:" name="phone" value="<?php echo $phone ?>" required>
      </div>
      <div class="input-group">
				<button name="submit" class="btn">UPDATE</button>
			</div>
		</form>
</body>
</html>
