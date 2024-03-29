<?php
  include 'connection.php';
	error_reporting(0);
  session_start();
  if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $sql = "INSERT INTO institutions (name, city, address) values('$name', '$city', '$address')";
    $result = mysqli_query($connect, $sql);
    if($result){
      header('Location: institution.php');
      $name = "";
      $city = "";
      $address = "";
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
  <title>Add an institution</title>
</head>
<body>
  <div class="container">
      <form action="" method="POST" class="login-email">
        <p class="login-text" style="font-size: 2rem; font-weight: 800;">Add an institution</p>
        <div class="input-group">
          <input type="text" placeholder="Name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="input-group">
          <input type="text" placeholder="City" name="city" value="<?php echo $city; ?>" required>
        </div>
        <div class="input-group">
          <input type="text" placeholder="Address" name="address" value="<?php echo $address; ?>" required>
        </div>
        <div class="input-group">
          <button name="submit" class="btn">Submit</button>
        </div>
        <p class="login-register-text">You can log in <a href="../index.php" style = "color:#00dc00;">HERE</a>.</p>
      </form>
    </div>
</body>
</html>
