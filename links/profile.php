<?php
  include '../login/connection.php';
	error_reporting(0);
  session_start();
  $user_id = $_SESSION['user_id'];
  // echo $user_id;
  $sql = "SELECT firstname, lastname FROM users where user_id = '$user_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$firstname = $row['firstname'];
    $lastname = $row['lastname'];
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
    $pfirstname = array();
    $plastname = array();
    $ssn = array();
    $j=0;
    for($i = 0; $i < $patient_count; $i++){
      $sql = "SELECT firstname, lastname,ssn FROM users WHERE user_id = '$patientuser_id[$i]'";
      $patientname = mysqli_query($connect, $sql);
      while ($row = $patientname -> fetch_assoc()){
        $patient_name[$j] = $row['lastname']. ' ';
        $patient_name[$j] .= $row['firstname']. ' ';
        $patient_name[$j] .= $row['ssn'];
        $pfirstname[$j] = $row['firstname'];
        $plastname[$j] = $row['lastname'];
        $ssn[$j] = $row['ssn'];
        $j++;
      }
    }
    $j=0;
  }elseif(!$doctor_id){
    $doctor = 0;
    $sql = "SELECT patient_id FROM patients WHERE user_id = $user_id";
    $patientid_query = mysqli_query($connect, $sql);
    while ($row = $patientid_query->fetch_assoc()) {
      $patient_id = $row['patient_id'];
    }
    $sql = "SELECT name FROM diagnostics WHERE patient_id = '$patient_id'";
    $query = mysqli_query($connect, $sql);
    // var_dump($query->num_rows);
    if($query->num_rows > 0) {
      while ($row = $query -> fetch_assoc()){
        $diagnostic_name[] = $row['name'];
      }
      $diagnostic_count = count($diagnostic_name);
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
  <title><?php echo $firstname?></title>
</head>
<body>
    <div class="navbar  navbar-expand-sm">
      <a class="nav-link" href="logout.php">Log Out</a>
      <a class="nav-link" href="settings.php">Settings</a>
      <a class="nav-link" href="profile.php"><?php echo $firstname ?></a>
      <a class="nav-link" href="home.php" >Home</a>
    </div>
      <div class="container-data">
        <?php
          if($doctor == 1){
            echo '<p style = "font-size: 3rem; text-align:center; color: #00dc00">Patients</p>';
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

          }else{
            echo '<p style = "font-size: 3rem; text-align:center; color: #00dc00">Diagnostics</p>';
          }
        ?>
        <ul class="list-group">
          <?php
            $num = 0;
            for ($i = 0 ; $i<$patient_count; $i++){
              $sql = "SELECT user_id FROM users WHERE firstname = '$pfirstname[$i]' AND lastname = '$plastname[$i]' AND ssn = '$ssn[$i]'";
              $result = mysqli_query($connect, $sql);
              while ($row = $result->fetch_assoc()){
                $puser_id = $row['user_id'];
              }
              $num = $i+1;
              echo "<li class='list-group-item'>".$num.". ".$patient_name[$i]."<a href='patient_file.php?puser_id=".$puser_id."' style = ' float:right;'>  EDIT <span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></li>";
            }
            $num = 0;
          ?>
        </ul>
        <ul class="list-group">
          <?php
            $num = 0;
            for ($i = 0 ; $i<$diagnostic_count; $i++){
              $sql = "SELECT diagnostic_id FROM diagnostics WHERE name = '$diagnostic_name[$i]'";
              $result = mysqli_query($connect, $sql);
              while ($row = $result->fetch_assoc()){
                $diagnostic_id = $row['diagnostic_id'];
              }
              $num = $i+1;
              echo "<li class='list-group-item'>".$num.". ".$diagnostic_name[$i]."<a href='diagnostic_data.php?diagnostic_id=".$diagnostic_id."' style = ' float:right;'>  EDIT <span class='glyphicon glyphicon-edit' aria-hidden='true'></span></a></li>";
            }
            $num = 0;
          ?>
        </ul>
      </div>
      <div class="container-profileinfo">
        <div class="first-profile">
          <div class="pfp">
            <?php
              $sql = "SELECT profile_picture FROM users WHERE user_id = '$user_id'";
              $result = mysqli_query($connect, $sql);
              while ($row = $result->fetch_assoc()) {
                $profile_picture = $row['profile_picture'];
              }
            ?>
            <img src="<?php
              if($profile_picture !=0)
              {
                echo $profile_picture;
              }else
              echo "../photos/profilepicture_default.png";
            ?>" alt="unplash">
          </div>
          <div class="name">
            <span style = "font-size: 20px; color: #00dc00;"><?php echo $firstname.' '.$lastname; ?></span>
          </div>
        </div>
        <div class="second-profile">
        <div class="user-data">
          <?php
          $sql = "SELECT email FROM users WHERE user_id = '$user_id'";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $email = $row['email'];
            }
            echo "<p style='font-size: 20px; color: #00dc00;'>$email</p>";
          if($doctor == 1) {
            $sql = "SELECT specialization, phone_number FROM doctors WHERE user_id = '$user_id'";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $doc_specialization = $row['specialization'];
              $doc_phone_number = $row['phone_number'];;
            }
            $sql = "SELECT institution_id FROM doctors WHERE user_id = '$user_id'";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $doctor_institution_id = $row['institution_id'];
            }
            $sql = "SELECT name, city, address FROM institutions WHERE institution_id = '$doctor_institution_id'";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $institution_name = $row['name'];
              $institution_city = $row['city'];
              $institution_address = $row['address'];
            }
            echo "<p style='font-size: 20px; color: #00dc00;'>$doc_specialization</p>";
            echo "<p style='font-size: 20px; color: #00dc00;'>$doc_phone_number</p>";
            echo "<p style='font-size: 20px; color: #00dc00;'>$institution_name</p>";
            echo "<p style='font-size: 20px; color: #00dc00;'>$institution_city  $institution_address</p>";
          }else{
            $sql = "SELECT age, height, weight, phone_number, doctor_id FROM patients WHERE user_id = '$user_id'";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $patient_age = $row['age'];
              $patient_height = $row['height'];
              $patient_weight = $row['weight'];
              $patient_phone_number = $row['phone_number'];
              $patient_doctor_id = $row['doctor_id'];
            }
            $sql = "SELECT user_id FROM doctors WHERE doctor_id = '$patient_doctor_id'";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $doctor_user_id = $row['user_id'];
            }
            $sql = "SELECT firstname, lastname FROM users WHERE user_id = '$doctor_user_id'";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $doctor_name = $row['firstname'].' ';
              $doctor_name .= $row['lastname'];
            }
            $sql = "SELECT institution_id FROM doctors WHERE doctor_id = '$patient_doctor_id'";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $patient_institution_id = $row['institution_id'];
            }
            $sql = "SELECT name, city, address FROM institutions WHERE institution_id = '$patient_institution_id'";
            $result = mysqli_query($connect, $sql);
            while ($row = $result->fetch_assoc()) {
              $patient_institution_data = $row['name']. ' ';
              $patient_institution_data .= $row['city']. ' ';
              $patient_institution_data .= $row['address'];
            }
            echo "<p style='font-size: 20px; color: #00dc00;'>$patient_height</p>";
            echo "<p style='font-size: 20px; color: #00dc00;'>$patient_weight</p>";
            echo "<p style='font-size: 20px; color: #00dc00;'>$patient_age</p>";
            echo "<p style='font-size: 20px; color: #00dc00;'>$patient_phone_number</p>";
            // echo "<p style='font-size: 20px; color: #00dc00;'>$patient_institution_data</p>";
            echo "<a href='doctor_data.php?doctor_id=".$patient_doctor_id."' style='font-size: 20px; color: #00ac00;'>$doctor_name</a>";
            echo "<p style='font-size: 20px; color: #00dc00;'>$patient_institution_data</p>";
          }
          ?>
          </div>
        </div>
      </div>
</body>
</html>
