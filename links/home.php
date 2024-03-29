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
  $sql = "SELECT doctor_id FROM doctors WHERE user_id = '$user_id'";
  $doctor = mysqli_query($connect, $sql);
  while ($row = $doctor->fetch_assoc()) {
		$doctor_id = $row['doctor_id'];
	}
  if($doctor_id){
    $doctor = 1;
  }else{
    $doctor = 0;
  }
  $sql = "SELECT title, body, user_id FROM articles ORDER BY article_id DESC";
  $query = mysqli_query($connect, $sql);
  if($query->num_rows > 0) {
    while ($row = $query -> fetch_assoc()){
      $article_title[] = $row['title'];
      $article_body[] = $row['body'];
      $article_user_id[]=$row['user_id'];
    }
    $article_count = count($article_title);
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
  <title>Home</title>
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
  <div class="add-button">
    <?php
      if($doctor==1){
        echo '<a href="add_article.php" role="button" class="btn btn-primary" >Add an article</a>';
      }
    ?>
  </div>
  <div class="articles">
      <ul class="list-group">
          <?php
            for ($i = 0 ; $i<$article_count; $i++){
              $sql = "SELECT article_id FROM articles WHERE title = '$article_title[$i]' AND body = '$article_body[$i]' AND user_id = '$article_user_id[$i]'";
              $result = mysqli_query($connect, $sql);
              while ($row = $result->fetch_assoc()){
                $article_id = $row['article_id'];
              }
              echo "<li class='list-group-item'><a style=' color:black; font-size:15px;' href='article_page.php?article_id=".$article_id."&article_user_id=".$article_user_id[$i]."'>".$article_title[$i]."</a></li>";
            }
          ?>
        </ul>
  </div>
</body>
</html>
