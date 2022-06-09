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
    $aname = $_POST['aname'];
    $abody = $_POST['abody'];
    $sql = "INSERT INTO articles (title, body, user_id) VALUES ('$aname','$abody', '$user_id')";
    $query = mysqli_query($connect, $sql);
    $aname = "";
    $abody = "";
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
  <title>Add an article</title>
</head>
<body>
  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <p class="navbar-brand">
          Medical Warehouse</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="home.php">Home</a></li>
        <li><a href="profile.php"><?php echo $firstname ?></a></li>
        <li><a href="settings.php">Settings</a></li>
        <li><a href="logout.php">Log Out</a></li>
      </ul>
    </div>
  </nav>
  <div class="div-article">
    <form action="" method="POST" class="login-email">
      <p style = "font-size: 3rem; text-align:center; color: #00dc00; margin-top: 10px;">Add an article</p>
			<div class="input-group" style="margin-top:50px;">
				<input type="text" placeholder="Article Name" name="aname" value="<?php echo $aname; ?>" required>
			</div>
			<div class="input-group">
				<textarea placeholder="Article body" name="abody" rows="20" cols="50" value="<?php echo $abody; ?>" required></textarea>
			</div>
			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
      </div>
		</form>
</body>
</html>
