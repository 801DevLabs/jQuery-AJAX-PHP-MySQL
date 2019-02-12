<?php
  require_once('./includes/db.php');
  $search = $_POST['search'];

  $query = "SELECT * FROM cars WHERE title LIKE '$search%'";
  $result = mysqli_query($connection, $query) or die ('Failed');
  $return = mysqli_num_rows($result);
  if($return > 0) {
    if($search != ""){
      while($row = mysqli_fetch_array($result)){
        $brand = $row['title'];
        echo "<ul class='list-unstyled'>";
        echo "<li>";
        echo $brand . " in stock";
        echo "</li>";
        echo "</ul>";
      }
    }
  } else {
    echo "No Results Found";
  }