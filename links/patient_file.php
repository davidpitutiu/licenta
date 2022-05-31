<?php
  include '../login/connection.php';
	error_reporting(0);
  session_start();
  $puser_id = $_GET['puser_id'];
  $user_id = $_SESSION['user_id'];
  // echo $user_id;
  $sql = "SELECT firstname FROM users where user_id = '$user_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = $result->fetch_assoc()) {
		$firstname = $row['firstname'];
	}
  // echo $puser_id;
  $sql = "SELECT firstname, lastname FROM users WHERE user_id = '$puser_id'";
  $result = mysqli_query($connect, $sql);
  while ($row = mysqli_fetch_array($result)){
    $username = $row['lastname']. ' ';
    $username .= $row['firstname'];
  }
  if (isset($_POST['submit'])) {
    $dname = $_POST['dname'];
    $ddescription = $_POST['ddescription'];
    $sql = "SELECT patient_id FROM patients WHERE user_id = '$puser_id'";
    $query = mysqli_query($connect, $sql);
    while ($row = $query->fetch_assoc()) {
			$patient_id = $row['patient_id'];
  	}
    $sql = "INSERT INTO diagnostics (name, description, patient_id) VALUES ('$dname', '$ddescription', '$patient_id')";
    $query = mysqli_query($connect, $sql);
    $sql = "SELECT diagnostic_id FROM diagnostics WHERE name = '$dname' AND description = '$ddescription' AND patient_id = '$patient_id'";
    $query = mysqli_query($connect, $sql);
    while ($row = $query->fetch_assoc()) {
			$diagnostic_id = $row['diagnostic_id'];
  	}
    $dname = "";
    $ddescription = "";
    $medication = $_POST['medication'];
    $dosage = $_POST['dosage'];
    $medication_count = count($medication);
    for($i = 0; $i < $medication_count; $i++){
      $sql = "INSERT INTO medication (name, dosage, diagnostic_id) VALUES ('$medication[$i]', '$dosage[$i]', '$diagnostic_id')";
      $query = mysqli_query($connect, $sql);
    }
    $diagnosis_id = "";
    $medication = "";
    $dosage = "";
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
  <title><?php echo $username; ?></title>
</head>
<body>
  <div class="navbar  navbar-expand-sm">
    <a class="nav-link" href="logout.php">Log Out</a>
    <a class="nav-link" href="settings.php">Settings</a>
    <a class="nav-link" href="profile.php"><?php echo $firstname ?></a>
    <a class="nav-link" href="home.php" >Home</a>
  </div>
  <div class="div-diagnostics">
    <h1 style = "color: #00dc00"><?php echo $username; ?></h1>
    <form action="" method="POST" class="login-email">
			<div class="input-group">
				<input type="text" placeholder="Diagnostic Name" name="dname" value="<?php echo $dname; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Diagnostic Description" name="ddescription" value="<?php echo $ddescription; ?>" required>
			</div>
      <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
      <script>
        $(document).ready(function() {
          var max_fields      = 100;
          var wrapper         = $("#input_fields_wrap");
          var add_button      = $("#add_field_button");

          var x = 1;


          $(add_button).click(function(e){ //on add input button click
              e.preventDefault();
              if(x < max_fields){ //max input box allowed

              //text box increment
                  $(wrapper).append('<div class="input-group"><input type="text" name="medication[]" style="width:50%;" placeholder="Add medication here" required/><input type="number" min = "0" style="width:20%;" name="dosage[]" placeholder="Per day" required/><button href="#" id="remove_field">Remove</button></div>');
                  x++;
              }
          });
          $(wrapper).on("click","#remove_field", function(e){
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
          });
        });
      </script>
      <div id="input_fields_wrap">
        <button id = "add_field_button" class = "btn btn-success">Add More Fields</button>
        <br>
        <br>
        <div class = "input-group">
          <input type="text" style="width:50%;" name="medication[]" placeholder="Add medication here"/>
          <input type="number" min ="0" style="width:20%; margin-right:60px;" name="dosage[]" placeholder="Per day"/>
        </div>
     </div>
			<div class="input-group">
				<button name="submit" class="btn">Submit</button>
      </div>
		</form>
  </div>
</body>
</html>
