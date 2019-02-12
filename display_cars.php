<?php
  require_once('./includes/db.php');

  $query = "SELECT * FROM cars";
  $result = mysqli_query($connection, $query) or die ("Connection Failed");

  while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td><a rel='".$row['id']."' class='title-link' href='javascript:void(0)'>{$row['title']}</a></td>";
    echo "</tr>";
  }
  ?>

  <script>
    $(document).ready(function(){

      $(".title-link").on('click', function(){
        $("#action-container").show();
        let id = $(this).attr("rel");
        $.post("process.php", {id:id}, function(data){
          $("#action-container").html(data);
        });
      });

    });
  </script>