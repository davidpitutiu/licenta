<?php
  session_start();
  include 'connection.php';
  error_reporting(0);
  $user_id = $_SESSION['user_id'];
  if (isset($_POST['submit'])) {
    $phone = $_POST['phone'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
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
    $sql = "INSERT INTO patients (user_id, phone_number, height, weight, age, doctor_id ) values('$user_id', '$phone', '$height', '$weight', '$age', '$id')";
    $result = mysqli_query($connect, $sql);

    if($result){
      echo "<script>alert('Data stored succsesfully.')</script>";
      $phone= "";
      $age = "";
      $height = "";
      $weight = "";
      $doctors = "";
      header('Location: ../links/profile.php');
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
  <title>Patient Data</title>
</head>
<body>
  <div class="container">
    <form action=""  method="POST">
      <p class="login-text" style="font-size: 2rem; font-weight: 800;">Patient Data</p>
      <div class="input-group">
        <input type="tel" placeholder="Enter your phone number:" name="phone" value="<?php echo $phone ?>" required>
      </div>
      <div class="input-group">
        <input type="text" placeholder="Add your height in centimeters here:" name="height" value="<?php echo $height; ?>" required>
      </div>
      <div class="input-group">
        <input type="text" placeholder="Add your weight in kilograms here:" name="weight" value="<?php echo $weight; ?>" required>
      </div>
      <div class="input-group">
        <input type="text" placeholder="Add your age here:" name="age" value="<?php echo $age; ?>" required>
      </div>
      <div class="input-group">
        <label for="doctors">Select a doctor:</label>
          <select name="doctors" >
            <?php
                $sql = mysqli_query($connect, "SELECT user_id FROM doctors");
                $i = 0;
                $use_id = array();
                while ($row = $sql->fetch_assoc()){
                  $use_id[$i] = $row['user_id'];
                  $i++;
                }
                $count = count($use_id);
                // $_SESSION['use_id']=$use_id;
                for($i = 0; $i < $count; $i++){
                  $sql = mysqli_query($connect, "SELECT firstname FROM users WHERE user_id = '$use_id[$i]'");
                  while ($row = $sql->fetch_assoc()){
                    $name = $row['firstname'];
                    echo '<option name = "'.$name.'" value="'.$name.'">' . $name. '</option>';
                  }
                }
            ?>
      </div>
      <div class="input-group">
         <input type="hidden">
      </div>
      <div class="input-group">
				<button class = "btn" name="submit">Submit</button>
			</div>
    </form>
  </div>
</body>
</html>
