<?php
  include 'includes/connect.php';

  function fetch_categories_list() {
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
        <tr id='$category->id'>
          <td>$i</td>
          <td>$category->code</td>
          <td>$category->name</td>
          <td>
            <button type='button' class='btn btn-primary' id='editBtn'><i class='fas fa-edit'></i></button>
            <button type='button' class='btn btn-danger' id='deleteBtn'><i class='fas fa-trash-alt'></i></button>
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
  if(isset($_GET['action']) && $_GET['action'] == 'fetchCategoriesList') {
    fetch_categories_list();
  }
?>
