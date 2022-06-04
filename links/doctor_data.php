<?php
  include '../login/connection.php';
  error_reporting(0);
  session_start();
  $doctor_id = $_GET['doctor_id'];
  $user_id = $_SESSION['user_id'];
  // echo $doctor_id;
  $sql = "SELECT user_id FROM doctors WHERE doctor_id = '$doctor_id'";
  $query = mysqli_query($connect, $sql);
  while ($row = $query->fetch_assoc()) {
		$doctor_user_id = $row['user_id'];
	}
  $sql = "SELECT firstname, lastname FROM users WHERE user_id = '$doctor_user_id'";
  $query = mysqli_query($connect, $sql);
  while ($row = $query->fetch_assoc()) {
		$doctor_fullname = $row['firstname'] .' ';
    $doctor_fullname .= $row['lastname'];
	}
  $sql = "SELECT firstname FROM users where user_id = '$user_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$firstname = $row['firstname'];
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
  <title><?php echo $doctor_fullname; ?></title>
</head>
<body>
    <div class="navbar  navbar-expand-sm">
      <a class="nav-link" href="logout.php">Log Out</a>
      <a class="nav-link" href="settings.php">Settings</a>
      <a class="nav-link" href="profile.php"><?php echo $firstname ?></a>
      <a class="nav-link" href="home.php" >Home</a>
    </div>
      <div class="container-profileinfo">
        <div class="first-profile">
          <div class="pfp">
            <?php
                  $sql = "SELECT profile_picture FROM users WHERE user_id = '$doctor_user_id'";
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
                <span style = "font-size: 20px; color: #00dc00;"><?php echo $doctor_fullname; ?></span>
          </div>
        </div>
            <div class="second-profile">
              <div class="user-data">
              <?php
              $sql = "SELECT email FROM users WHERE user_id = '$doctor_user_id'";
                $result = mysqli_query($connect, $sql);
                while ($row = $result->fetch_assoc()) {
                  $email = $row['email'];
                }
                echo "<p style='font-size: 20px; color: #00dc00;'>$email</p>";
                $sql = "SELECT specialization, phone_number FROM doctors WHERE user_id = '$doctor_user_id'";
                $result = mysqli_query($connect, $sql);
                while ($row = $result->fetch_assoc()) {
                  $doc_specialization = $row['specialization'];
                  $doc_phone_number = $row['phone_number'];;
                }
                $sql = "SELECT institution_id FROM doctors WHERE user_id = '$doctor_user_id'";
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
              ?>
            </div>
          </div>
</body>
</html>
