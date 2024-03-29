<?php
  include '../login/connection.php';
	error_reporting(0);
  session_start();
  $user_id = $_SESSION['user_id'];
  // echo $user_id;
  $article_id = $_GET['article_id'];
  // echo $article_id;
  $article_user_id = $_GET['article_user_id'];
  // echo $article_user_id;
  $sql = "SELECT firstname FROM users where user_id = '$user_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$firstname = $row['firstname'];
	}
  $sql = "SELECT title, body FROM articles where article_id = '$article_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$article_title = $row['title'];
    $article_body = $row['body'];
	}
  $sql ="SELECT firstname, lastname FROM users WHERE user_id = '$article_user_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$poster_name = $row['firstname']. ' ';
    $poster_name .= $row['lastname'];
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
  <title><?php echo $article_title ?></title>
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
  <div class="show-article">
    <p style = "font-size: 3rem; text-align:center; color: #00dc00; margin-top: 10px; word-wrap: break-word;"><?php echo $article_title ?></p>
    <p style = "font-size: 2rem; text-align:right; color: #00dc00; margin-top: 10px; word-wrap: break-word;"><?php echo $poster_name ?></p>
    <br>
    <p style = "margin:10px; text-align:left;"><?php echo $article_body; ?></p>
  </div>
</body>
</html>
