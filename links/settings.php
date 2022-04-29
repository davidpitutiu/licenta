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
  if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
  	$lname = $_POST['lname'];
    $phone = $_POST['phone'];
    // $email = $_POST['email'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $age = $_POST['age'];
    $description = $_POST['description'];
    $specialization = $_POST['specialization'];
    if(!empty($_POST['doctors'])) {
      $doctors = $_POST['doctors'];
    }
    $sql = "SELECT user_id FROM users WHERE firstname = '$doctors'";
    $result = mysqli_query($connect, $sql);
    $usr_id = array();
    while ($row = $result->fetch_assoc()) {
      $usr_id[] = $row['user_id'];
    }
    $count = count($usr_id);
    $sql = "SELECT user_id FROM doctors";
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) {
      $us_id = $row['user_id'];
      foreach($usr_id as $user){
        if($us_id == $user)
        {
          $id = $us_id;
        }
      }
    }
    $sql = "SELECT doctor_id FROM doctors WHERE user_id = '$id'";
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) {
      $doc_id = $row['doctor_id'];
    }
    if(!empty($_POST['institutions'])) {
      $institution = $_POST['institutions'];
    }
    echo $institution;
    $sql = "SELECT institution_id FROM institutions WHERE name = '$institution'";
    $result = mysqli_query($connect, $sql);
    while ($row = $result->fetch_assoc()) {
      $institution_id = $row['institution_id'];
    }
    if($doc_id){
      $sql = "UPDATE patients SET doctor_id = '$doc_id' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $doctors= "";
    }
    if($institution_id){
      $sql = "UPDATE doctors SET institution_id = '$institution_id' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $institution_id = "";
      $institution = "";
    }
    if($description){
      $sql = "UPDATE doctors SET description = '$description' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $institution_id = "";
      $institution = "";
    }
    if($specialization){
      $sql = "UPDATE doctors SET specialization = '$specialization' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $institution_id = "";
      $institution = "";
    }
    if($fname){
      $sql = "UPDATE users SET firstname = '$fname' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $fname= "";
    }
    if($lname){
      $sql = "UPDATE users SET lastname = '$lname' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $lname = "";
    }
    if($age){
      $sql = "UPDATE patients SET age = '$age' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $age= "";
    }
    if($height){
      $sql = "UPDATE patients SET height = '$height' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $height= "";
    }
    if($weight){
      $sql = "UPDATE patients SET weight = '$weight' WHERE user_id = '$user_id'";
      $result = mysqli_query($connect, $sql);
      $weight= "";
    }
    // if($email){
    //   $sql = "UPDATE users SET email = '$email' WHERE user_id = '$user_id'";
    //   $result = mysqli_query($connect, $sql);
    //   $email= "";
    // }
    $_SESSION['doctor_id']=$doctor_id;
    if($phone){
      if($doctor_id){
        $sql = "UPDATE doctors SET phone_number = '$phone' WHERE user_id = '$user_id'";
        $result = mysqli_query($connect, $sql);
        $phone = "";
      }else{
        $sql = "UPDATE patients SET phone_number = '$phone' WHERE user_id = '$user_id'";
        $result = mysqli_query($connect, $sql);
        $phone = "";
      }
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
  <title>Settings</title>
</head>
<body>
  <header>
    <div class="navbar  navbar-expand-sm">
      <a class="nav-link" href="logout.php">Log Out</a>
      <a class="nav-link" href="settings.php">Settings</a>
      <a class="nav-link" href="profile.php"><?php echo $firstname ?></a>
      <a class="nav-link" href="home.php" >Home</a>
    </div>
  </header>
  <div class="container">
		<form action="" method="POST" class="settings">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Settings</p>
			<div class="input-group">
				<input type="text" placeholder="Last Name" name="lname" value="<?php echo $lname; ?>">
			</div>
      <div class="input-group">
				<input type="text" placeholder="First Name" name="fname" value="<?php echo $fname; ?>">
      </div>
			<div class="input-group">
        <input type="tel" placeholder="Enter your phone number:" name="phone" pattern="[0-9]{10}" value="<?php echo $phone ?>">
      </div>
      <!-- <div class="input-group">
				<input type="email" placeholder="Email" name="email" value="<?php //echo $email; ?>">
			</div> -->
      <br>
      <?php
        if($doctor_id){
          // echo "<div class='input-group'>
          //         <input type='text' placeholder='Add your specialization here:' name='specialization' value= ".$specialization.">
          //       </div>
          //       <div class='input-group'>
          //         <input type='text' placeholder='Add your description here:' name='description' value=".$description.">
          //       </div>";
          $sql = mysqli_query($connect, 'SELECT name FROM institutions');
          echo "<div class='input-group'>
            <label for='institution'>Change the institution:</label>
              <select name='institutions'>
              <option name = 'NULL' value = ''></option>
              "; while ($row = $sql->fetch_assoc()){
                $name = $row['name'];
                echo '<option name = "'.$name.'" value="'.$name.'">' . $name. '</option>';
              }"
          </div>";
        }else{
          echo "<div class='input-group'>
				          <input type='weight' placeholder='Weight' name='weight' value='$weight'>
			          </div>
                <div class='input-group'>
				          <input type='height' placeholder='Height' name='height' value='$height'>
			          </div>
                <div class='input-group'>
				          <input type='age' placeholder='Age' name='age' value='$age'>
			          </div>";
          echo "<div class='input-group'>
                <label for='doctors'>Select a doctor:</label>
                <select name='doctors' >
                <option name = 'NULL' value = ''></option>";
          $sql = mysqli_query($connect, "SELECT user_id FROM doctors");
          $i = 0;
          $use_id = array();
          while ($row = $sql->fetch_assoc()){
            $use_id[$i] = $row['user_id'];
            $i++;
          }
          $count = count($use_id);
          for($i = 0; $i < $count; $i++){
            $sql = mysqli_query($connect, "SELECT firstname, lastname FROM users WHERE user_id = '$use_id[$i]'");
            while ($row = $sql->fetch_assoc()){
              $name = $row['firstname'];
              $lastname = $row['lastname'];
              echo '<option name = "'.$name.'" value="'.$name.'">' . $name.' '. $lastname. '</option>';
            }
          }
          echo "</>";
        }
      ?>
      <div class="input-group">
         <input type="hidden">
      </div>
      <div class="input-group">
         <input type="hidden">
      </div>
      <div class="input-group">
				<button name="submit" class="btn">UPDATE</button>
			</div>
		</form>
</body>
</html>
