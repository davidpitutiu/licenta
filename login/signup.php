<?php

include 'connection.php';
error_reporting(0);

session_start();

if (isset($_POST['submit'])) {
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	$cpassword = md5($_POST['cpassword']);
	$doctorCheck = $_POST['doctorCheck'];
	$em = $_POST['email'];

	if ($password == $cpassword) {
		$sql = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($connect, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO users (email, user_password, firstname, lastname)
					VALUES ('$email', '$password', '$fname', '$lname')";
			$result = mysqli_query($connect, $sql);
			if ($result) {
				echo "<script>alert('Account created succsesfully.')</script>";
				if($doctorCheck == 1)
				{
					$sql = "SELECT user_id FROM users WHERE email = '$email'";
					$result = mysqli_query($connect, $sql);
					while ($row = $result->fetch_assoc()) {
						$user_id = $row['user_id'];
					}
					header('Location: doctor_data.php');
					$_SESSION['user_id'] = $user_id;
				}else{
						$sql = "SELECT user_id FROM users WHERE email = '$email'";
					$result = mysqli_query($connect, $sql);
					while ($row = $result->fetch_assoc()) {
						$user_id = $row['user_id'];
					}
					header('Location: patient_data.php');
					$_SESSION['user_id'] = $user_id;
				}
				$fname = "";
				$lname = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
				$doctorCheck = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}

	} else {
		echo "<script>alert('Password Not Matched.')</script>";
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
  <link rel="stylesheet" href="../style.css">
  <title>Sign Up</title>
</head>
<body>
  <!-- Sign Up form  -->
  <div class="container">
		<form action="" method="POST" class="login-email">
          <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
			<div class="input-group">
				<input type="text" placeholder="First Name" name="fname" value="<?php echo $fname; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Last Name" name="lname" value="<?php echo $lname; ?>" required>
			</div>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"   required title="Password must be 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div>
					<input type="checkbox" class="defaultCheckbox" name="doctorCheck" value="1">
					<label for='doctor-check'>Are you a doctor?</label>
			</div>
			<br>
			<div class="input-group">
				<button name="submit" class="btn">Sign Up</button>
			</div>
			<p class="login-register-text">Have an account? <a href="../index.php">Log In Here</a>.</p>
		</form>
	</div>
</body>
</html>
