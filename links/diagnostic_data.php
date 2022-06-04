<?php
  include '../login/connection.php';
	error_reporting(0);
  session_start();
  $diagnostic_id = $_GET['diagnostic_id'];
  $user_id = $_SESSION['user_id'];
    $sql = "SELECT firstname FROM users where user_id = '$user_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$firstname = $row['firstname'];
	}
  $sql = "SELECT name FROM diagnostics WHERE diagnostic_id = '$diagnostic_id'";
  $query = mysqli_query($connect, $sql);
  while ($row = $query->fetch_assoc()){
    $diagnostic_name = $row['name'];
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
    <title><?php echo $diagnostic_name; ?></title>
  </head>
  <body>
    <div class="navbar  navbar-expand-sm">
      <a class="nav-link" href="logout.php">Log Out</a>
      <a class="nav-link" href="settings.php">Settings</a>
      <a class="nav-link" href="profile.php"><?php echo $firstname ?></a>
      <a class="nav-link" href="home.php" >Home</a>
    </div>
    <div class="container-diagnostics">
      <p style = "font-size: 4rem; text-align:center; color: #00dc00"><?php echo $diagnostic_name; ?></p>
      <br>
      <br>
      <br>
      <br>
      <?php
        $sql = "SELECT description FROM diagnostics WHERE diagnostic_id = '$diagnostic_id'";
        $query = mysqli_query($connect, $sql);
        while ($row = $query->fetch_assoc()){
          $description = $row['description'];
        }
        echo "<p style='font-size: 2rem; text-align:left; margin-left: 5rem;'>". $description ."</p>";
      ?>
      <p style = "font-size: 4rem; text-align:center; color: #00dc00">Medication</p>

      <ul>
        <?php
          $sql = "SELECT name, dosage FROM medication WHERE diagnostic_id = '$diagnostic_id'";
          $query = mysqli_query($connect, $sql);
          while ($row = $query->fetch_assoc()){
            $medication[] = $row['name'].' - '.$row['dosage'].' times a day';
          }
          $medication_count = count($medication);
          $num=0;
          for($i = 0; $i < $medication_count; $i++){
            $num = $i+1;
            echo "<li class='list-group-item' style='text-align:left;'>" .$num. ". " .$medication[$i]. "</li>";
          }
          $num = 0;
        ?>
      </ul>
    </div>
  </body>
  </html>
