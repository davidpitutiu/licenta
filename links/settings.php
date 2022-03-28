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
    $fname = $_POST['fname'];
  	$lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $sql = "SELECT doctor_id FROM doctors WHERE user_id = '$user_id'";
    $doctor = mysqli_query($connect, $sql);
    while ($row = $doctor->fetch_assoc()) {
      $doctor_id = $row['doctor_id'];
    }
    if($fname){
      $sql = "UPDATE users SET firstname = '$fname' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $fname= "";
    }
    if($lname){
      $sql = "UPDATE users SET lastname = '$lname' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $lname = "";
    }
    if($email){
      $sql = "UPDATE users SET email = '$email' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $email= "";
    }
    $_SESSION['doctor_id']=$doctor_id;
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
				<input type="text" placeholder="Last Name" name="lname" value="<?php echo $lname; ?>">
			</div>
      <div class="input-group">
				<input type="text" placeholder="First Name" name="fname" value="<?php echo $fname; ?>">
      </div>
			<div class="input-group">
        <input type="tel" placeholder="Enter your phone number:" name="phone" pattern="[0-9]{10}" value="<?php echo $phone ?>">
      </div>
      <div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>">
			</div>
      <br>
      <?php
        $doctor_id = $_SESSION['doctor_id'];
        if($doctor_id){
          print_r($doctor_id);
          echo "<div class='input-group'>
            <label for='institution'>Select a institution:</label>
              <select name='institutions' >
            ".$sql = mysqli_query($connect, 'SELECT name FROM institutions');
              while ($row = $sql->fetch_assoc()){
              $name = $row["name"];
              echo "<option name = '".$name."' value='".$name."'>" . $name. "</option>";
              } "
          </div>";
        }
      ?>
      <div class="input-group">
         <input type="hidden">
      </div>
      <div class="input-group">
				<button name="submit" class="btn">UPDATE</button>
			</div>
		</form>
</body>
</html>
