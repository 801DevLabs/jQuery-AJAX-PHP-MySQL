<?php
  require_once('./includes/db.php');

  if(isset($_POST['car_name'])){
    $car_name = $_POST['car_name'];
    $query = "INSERT INTO cars(title) VALUES('$car_name')";
    $result = mysqli_query($connection, $query) or die ("Car Name Query Failed");
    // header("Location: /AJAX%20Demo/");
  }
  ?>