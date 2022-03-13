<?php
  include 'login/connection.php';
	error_reporting(0);
  session_start();
  if (isset($_POST['submit'])) {
		$email = $_POST['email'];
		$password = md5($_POST['password']);


		$sql = "SELECT * FROM users WHERE email='$email' AND user_password='$password'";
		$result = mysqli_query($connect, $sql);
		if ($result->num_rows > 0) {
			$row = mysqli_fetch_assoc($result);
			$_SESSION['email'] = $row['email'];
			header("Location: links/profile.php");
		} else {
			echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
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
  <title>Login</title>
</head>
<body>
  <!-- Log In -->
    <div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Log In</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="login/signup.php">Sign Up Here</a>.</p>
		</form>
	</div>
</body>
</html>
