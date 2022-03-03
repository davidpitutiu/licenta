<?php
  //Database connection
  $servername = "localhost";
  $username = "root";
  $password = "";
  $connect = mysqli_connect($servername,$username,$password);
  //Checks connection and prints a message
  if($connect){
    echo "Connected Succsesfully! <br>";
    $query = "CREATE DATABASE medicalwarehouse";
    $createdatabase = mysqli_query($connect, $query);
    if($createdatabase){
      echo "Database created succsesfully! <br>";
    }else{
      echo "Failed to create database! <br>";
    }
  }else{
    echo "Connection Failed! <br>";
  }
?>
