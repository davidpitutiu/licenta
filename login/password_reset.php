<?php
  include 'connection.php';
	error_reporting(0);
  session_start();
  if (isset($_POST['submit'])) {
    $email =  $_SESSION['reset_email'];
    $password = md5($_POST['password']);
	  $cpassword = md5($_POST['cpassword']);
    $tok = $_POST['token'];
    $sql = "SELECT token from users WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) {
      $token = $row['token'];
    }
    if($tok == $token){
      if ($password == $cpassword) {
	    	$sql = "UPDATE users SET user_password = '$password' WHERE email = '$email'";
        echo $sql;
        $result = mysqli_query($connect, $sql);
        $password= "";
        header("Location: ../index.php");
        echo "<script>alert('The password was changed successfuly!')</script>";
      }else{
        echo "<script>alert('The passwords don't match!')</script>";
      }
    }else{
      echo "<script>alert('The code doesn't match with our database. Try again!')</script>";
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
  <title>Forgot password</title>
</head>
<body>
  <div class="container">
		<form action="" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Forgot password?</p>
      <p class="login-text">We've sent a verification code on the email that you provided us!</p>
      <div class="input-group">
				<input type="text" placeholder="Verification Code" name="token" value="<?php echo $tok; ?>">
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"   required title="Password must be 8 characters including 1 uppercase letter, 1 lowercase letter and numeric characters" name="password" value="<?php echo $_POST['password']; ?>" required>
            </div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
			</div>
		</form>
	</div>
</body>
</html>
