<?php
//Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $databasename = "medicalwarehouse";
  $connect = mysqli_connect($servername, $username, $password, $databasename);
  //Checks connection and prints a message
  if($connect){
    echo "Connected Succsesfully! <br>";
    //If the connection has been succsesfull then it creates the tables
    $createtable1 = mysqli_query($connect, "CREATE TABLE users (
        user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100),
        user_password VARCHAR(50),
        firstname VARCHAR(100),
        lastname VARCHAR(100)
      )"
    );
    //Checks if the table has been created
    if($createtable1){
        echo "Users table created succsesfully! <br>";
    }else{
        echo "Failed to create users table! <br>";
    }
    $createtable2 = mysqli_query($connect, "CREATE TABLE medication (
        medication_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        description LONGTEXT,
        dosage INT UNSIGNED,
        duration VARCHAR(100)
      )"
    );
    //Checks if the table has been created
    if($createtable2){
        echo "Medication table created succsesfully! <br>";
    }else{
        echo "Failed to create medication table! <br>";
    }
    $createtable3 = mysqli_query($connect, "CREATE TABLE institutions (
        institution_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        description LONGTEXT,
        city VARCHAR(100),
        address VARCHAR(200),
        open_hours LONGTEXT,
        rating_institution INT UNSIGNED
      )"
    );
    //Checks if the table has been created
    if($createtable3){
        echo "Institutions table created succsesfully! <br>";
    }else{
        echo "Failed to create institutions table! <br>";
    }
    $createtable4 = mysqli_query($connect, "CREATE TABLE diagnostics (
        diagnostic_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100),
        description LONGTEXT,
        status VARCHAR(100),
        medication_id INT UNSIGNED,
        FOREIGN KEY (medication_id) REFERENCES medication(medication_id)
      )"
    );
    //Checks if the table has been created
    if($createtable4){
        echo "Diagnostics table created succsesfully! <br>";
    }else{
        echo "Failed to create diagnostics table! <br>";
    }
    $createtable5 = mysqli_query($connect, "CREATE TABLE doctors (
        doctor_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        specialization VARCHAR(100),
        doctor_rating INT UNSIGNED,
        description LONGTEXT,
        phone_number VARCHAR(15),
        institution_id INT UNSIGNED,
        FOREIGN KEY (institution_id) REFERENCES institutions(institution_id),
        user_id INT UNSIGNED,
        FOREIGN KEY (user_id) REFERENCES users(user_id)
      )"
    );
    //Checks if the table has been created
    if($createtable5){
        echo "Doctors table created succsesfully! <br>";
    }else{
        echo "Failed to create doctors table! <br>";
    }
    $createtable6 = mysqli_query($connect, "CREATE TABLE patients (
        patient_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        height INT UNSIGNED,
        weight INT UNSIGNED,
        age INT UNSIGNED,
        phone_number VARCHAR(15),
        doctor_id INT UNSIGNED,
        FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id),
        user_id INT UNSIGNED,
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        diagnostic_id INT UNSIGNED,
        FOREIGN KEY (diagnostic_id) REFERENCES diagnostics(diagnostic_id),
        medication_id INT UNSIGNED,
        FOREIGN KEY (medication_id) REFERENCES medication(medication_id)

      )"
    );
    //Checks if the table has been created
    if($createtable6){
        echo "Patients table created succsesfully! <br>";
    }else{
        echo "Failed to create patients table! <br>";
    }
    $createtable7 = mysqli_query($connect, "CREATE TABLE appointments (
        appointment_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        date_time DATETIME,
        institution_id INT UNSIGNED,
        FOREIGN KEY (institution_id) REFERENCES institutions(institution_id),
        patient_id INT UNSIGNED,
        FOREIGN KEY (patient_id) REFERENCES patients(patient_id)
      )"
    );
    //Checks if the table has been created
    if($createtable7){
        echo "Appointments table created succsesfully! <br>";
    }else{
        echo "Failed to create appointments table! <br>";
    }
  }else{
    echo "Connection Failed! <br>";
  }
?>
