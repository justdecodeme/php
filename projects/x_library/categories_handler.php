<?php
  include 'includes/connect.php';

  function returnCategories() {
    global $connection;
    $query = "SELECT * FROM categories ORDER BY code";
    $statement = $connection->prepare($query);
    if($statement->execute()) {
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      $categories_list = '';
      $i = 0;
      foreach($row as $category) {
        $i++;
        $categories_list .= "
        <tr>
          <td>$i</td>
          <td class='code'>$category->code</td>
          <td class='name'>$category->name</td>
          <td>
            <button type='button' class='btn btn-primary reading' data-id='$category->id' id='editBtn'><i class='fas fa-edit'></i></button>
            <button type='button' class='btn btn-danger reading' data-id='$category->id' id='deleteBtn'><i class='fas fa-trash-alt'></i></button>
            <button type='button' class='btn btn-primary editing' data-id='$category->id' id='cancelBtn'><i class='fas fa-times'></i></button>
            <button type='button' class='btn btn-success editing' data-id='$category->id' id='submitBtn'><i class='fas fa-check'></i></button>
          </td>
        </tr>
        ";
      }
      echo $categories_list;
    } else {
      echo "Something went wrong!";
    }
  }

  // fetch batch list
  if(isset($_GET['action']) && $_GET['action'] == 'fetchCategories') {
    returnCategories();
  }

  // Delete item on click of delete button
  if(isset($_POST['action']) && $_POST['action'] == 'delete') {
    $delete_id = $_POST['deleteId'];

    $query = "DELETE FROM categories WHERE id=$delete_id LIMIT 1";
    $statement = $connection->prepare($query);
    if($statement->execute()) {
      returnCategories();
    } else {
      echo "Something went wrong!";
    }

    // update_timetable_list($batch_code, $batch_template);
  }
?>
