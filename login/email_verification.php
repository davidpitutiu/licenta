<?php
include 'connection.php';
error_reporting(0);
session_start();
$email = $_SESSION['email'];
$doctorCheck = $_SESSION['doctorCheck'];
if (isset($_POST['submit'])) {
  $tok = $_POST['token'];
  $sql = "SELECT token from users WHERE email = '$email'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$token = $row['token'];
  }
  $sql = "SELECT user_id from users WHERE email = '$email'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$user_id = $row['user_id'];
  }
  if($tok == $token){
    $sql = "UPDATE users SET active = '1' WHERE email = '$email'";
    $result = mysqli_query($connect, $sql);
    echo "<script>alert('Verification was successful!')</script>";
    $_SESSION['user_id'] = $user_id;
    header('Location: ../links/profile.php');
  }else{
    echo "<script>alert('The code doesn't match with our database. Try again!')</script>";
  }
}
if (isset($_POST['resend'])){
  $token = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
  $sql = "UPDATE users SET token = '$token' WHERE email = '$email'";
  $result = mysqli_query($connect, $sql);
  $headers = "From: lucrarelicenta <lucrarelicenta.dip2022@gmail.com> \r\n";
  $to = $email;
  $subject = "Please verify your account!";
  $message = 'This is your new verification code: '.$token.' ';
  mail($to, $subject, $message, $headers);
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
  <title>Email Verification</title>
</head>
<body>
  <div class="container">
		<form action="" method="POST" class="login-email">
          <p class="login-text" style="font-size: 2rem; font-weight: 800;">Verify your email</p>
          <p class="login-text">We've sent you a verification code on your email!</p>
			<div class="input-group">
				<input type="text" placeholder="Verification Code" name="token" value="<?php echo $tok; ?>">
			</div>

			<div class="input-group">
				<button name="submit" class="btn">Verify</button>
			</div>
      <div class="input-group">
       <p class="login-register-text">Didn't recieve a code? <button name="resend" style = 'border:none; color:blue; background-color:white;'>Resend code</button></p>
      </div>
		</form>
	</div>
</body>
</html>
