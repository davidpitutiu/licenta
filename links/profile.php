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
    $sql = "SELECT user_id FROM patients WHERE doctor_id = '$doctor_id'";
    $patient_userid = mysqli_query($connect, $sql);
    $patientuser_id = array();
    while ($row = $patient_userid -> fetch_assoc()){
      $patientuser_id[] = $row['user_id'];
    }
    $patient_count = count($patientuser_id);
    $patient_name = array();
    for($i = 0; $i < $patient_count; $i++){
      $sql = "SELECT firstname FROM users WHERE user_id = '$patientuser_id[$i]'";
      $patientname = mysqli_query($connect, $sql);
      while ($row = $patientname -> fetch_assoc()){
        $patient_name[] = $row['firstname'];
      }
    }
  }else{
    $doctor = 0;
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
  <title><?php echo $firstname?></title>
</head>
<body>
    <div class="navbar  navbar-expand-sm">
      <a class="nav-link" href="logout.php">Log Out</a>
      <a class="nav-link" href="settings.php">Settings</a>
      <a class="nav-link" href="profile.php"><?php echo $firstname ?></a>
      <a class="nav-link" href="home.php" >Home</a>
    </div>
  <div class="container">
    <?php
      if($doctor == 1){
        $sql = "SELECT user_id FROM patients WHERE doctor_id = '$doctor_id'";
        $result=mysqli_query($connect, $sql);
        $id = array();
        $i = 0;
        while($row = $result->fetch_assoc()){
          $id[$i]=$row['user_id'];
          $i++;
        }
        $i = 0;
        $count = count($id);
        $j = 0;
        $patient = array();
        for($i = 0; $i < $count; $i++){
          $sql = "SELECT firstname FROM users WHERE user_id = '$id[$i]'";
          $result=mysqli_query($connect, $sql);
          while($row = $result->fetch_assoc()){
            $patient[$j]=$row['firstname'];
            $j++;
          }
        }
        $j = 0;
        $sql = "SELECT institution_id FROM doctors WHERE doctor_id = '$doctor_id'";
        $result=mysqli_query($connect, $sql);
        while($row = $result->fetch_assoc()){
          $institution_id=$row['institution_id'];
        }
        $sql = "SELECT name FROM institutions WHERE institution_id = '$institution_id'";
        $result=mysqli_query($connect, $sql);
        while($row = $result->fetch_assoc()){
          $institution=$row['name'];
        }
      }
      echo $institution;
    ?>
    <ul class="list-group">
      <?php
        for ($i = 0 ; $i<$patient_count; $i++){
          echo "<li class='list-group-item'>".$patient_name[$i]."<a href='patient_file.php'> EDIT <span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></li>";
        }
      ?>
    </ul>
  </div>
</body>
</html>
