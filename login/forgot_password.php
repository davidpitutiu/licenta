<?php
  include 'connection.php';
	error_reporting(0);
  session_start();
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $_SESSION['reset_email'] = $email;
    $token = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $sql = "UPDATE users SET token = '$token' WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    $headers = "From: lucrarelicenta <lucrarelicenta.dip2022@gmail.com> \r\n";
    $to = $email;
    $subject = "Password reset code";
    $message = 'This is your verification code for changing your password: '.$token.' ';
    mail($to, $subject, $message, $headers);
    header("Location: password_reset.php");
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
      <p class="login-text">Enter the email linked to your account</p>
			<div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
			</div>
		</form>
	</div>
</body>
</html>
