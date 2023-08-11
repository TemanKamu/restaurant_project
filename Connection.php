<?php
  $hostname = "localhost";
  $username = "root";
  $password = "";
  $db_name = "datarestoran";
  //Connecntion
  try{
      $connect = new PDO("mysql:host=$hostname;dbname=$db_name","$username","$password");
  }catch(PDOException $e){
      echo "Error: ". $e->getMessage();
  }

?>