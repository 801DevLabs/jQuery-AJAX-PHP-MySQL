<?php
  require_once('./includes/db.php');

  // GET ITEM INFO AND DISPLAY UPDATE AND DELETE BUTTONS
  if(isset($_POST['id'])){
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $query = "SELECT * FROM cars WHERE id = {$id}";
    $result = mysqli_query($connection, $query) or die ("Connection Failed");

    while($row = mysqli_fetch_array($result)){
      $title = $row['title'];
      $id = $row['id'];
      echo '<p id="feedback" class="bg-success"></p>';
      echo "<input rel='".$id."' type='text' class='form-control title-input' value='".$title."'>";
      echo "<button class='btn btn-success update'>Update</button>";
      echo "<button class='btn btn-danger delete'>Delete</button>";
      echo "<button class='btn btn-default'>Close</button>";
    }
  }

  // UPDATE FUNCTION
  if(isset($_POST['updateItem'])){
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $title = mysqli_real_escape_string($connection, $_POST['title']);

    $query = "UPDATE cars SET title = '$title' WHERE id = $id";
    $result = mysqli_query($connection, $query) or die ("Query Failed" . mysqli_error($connection));
  }

  // DELETE FUNCTION
  if(isset($_POST['deleteItem'])){
    $id = mysqli_real_escape_string($connection, $_POST['id']);

    $query = "DELETE FROM cars WHERE id = $id";
    $result = mysqli_query($connection, $query) or die ("Query Failed" . mysqli_error($connection));
  }  

  ?>

  <script>
    let id;
    let title;
    let updateItem = "Update";
    let deleteItem = "Delete";

    // GET TITLE AND ID
    $('.title-input').on("input", function(){
      id = $(this).attr("rel");
      title = $(this).val();
    });

    // UPDATE BUTTON FUNCION
    $('.update').on("click", function(){
      $.post("process.php", {id: id, title: title, updateItem: updateItem}, function(data){
          $('#feedback').text("Record updated succesfully");
      });
    });

    // DELETE BUTTON FUNCTION
    $('.delete').on("click", function(){
      if(confirm("Are you sure you want to delete " + $(".title-input").val() + "?")){
      id = $(".title-input").attr("rel");
      $.post("process.php", {id: id, title: title, deleteItem: deleteItem}, function(data){
        alert("DELETED");

        $("#action-container").hide();
      });
      }
    });

    // CLOSE BUTTON FUNCTION
    $(".btn-default").on("click", function(){
      $("#action-container").hide();
    });

  </script>