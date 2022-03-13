<?php
  session_start();
  include 'connection.php';
  error_reporting(0);
  $user_id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <title>Doctor data</title>
</head>
<body>
  <div class="container">
    <form action=""  method="POST">
      <p class="login-text" style="font-size: 2rem; font-weight: 800;">Doctor Data</p>
      <div class="input-group">
        <input type="tel" placeholder="Enter your phone number:" name="phone" value="<?php echo $phone ?>" required>
      </div>
      <div class="input-group">
        <input type="text" placeholder="Add your specialization here:" name="specialization" value="<?php echo $specialization; ?>" required>
      </div>
      <div class="input-group">
        <input type="text" placeholder="Add your description here:" name="description" value="<?php echo $description; ?>" required>
      </div>
      <div class="input-group">
        <label for="institution">Select a institution:</label>
          <select name="institutions" id="institution">
            <?php
              $sql = mysqli_query($connect, "SELECT name FROM institutions");
              while ($row = $sql->fetch_assoc()){
                echo '<option value="'.$row['name'].'">' . $row['name'] . '</option>';
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
