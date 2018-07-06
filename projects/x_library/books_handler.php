<?php
  include 'includes/connect.php';

  function returnBooks() {
    global $connection;
    $query = "SELECT * FROM books ORDER BY title";
    $statement = $connection->prepare($query);
    if($statement->execute()) {
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      $books_list = '';
      $i = 0;
      foreach($row as $book) {
        $i++;
        $books_list .= "
        <tr>
          <td>$i</td>
          <td class='book-title'>$book->title</td>
          <td class='book-author'>$book->author</td>
          <td class='book-stock'>$book->stock</td>
          <td class='book-category'>$book->category_id</td>
          <td>
            <button type='button' class='btn btn-primary reading' data-id='$book->id' id='editBtn'><i class='fas fa-edit'></i></button>
            <button type='button' class='btn btn-danger reading' data-id='$book->id' id='deleteBtn'><i class='fas fa-trash-alt'></i></button>
            <button type='button' class='btn btn-success editing' data-id='$book->id' id='submitBtn'><i class='fas fa-check'></i></button>
            <button type='button' class='btn btn-primary editing' data-id='$book->id' id='cancelBtn'><i class='fas fa-times'></i></button>
          </td>
        </tr>
        ";
      }
      echo $books_list;
    } else {
      echo "Something went wrong!";
    }
  }

  // fetch batch list
  if(isset($_GET['action']) && $_GET['action'] == 'fetchBooks') {
    returnBooks();
  }

  // Add category on click of add button
  if(isset($_POST['action']) && $_POST['action'] == 'add') {
    $addCode = $_POST['addCode'];
    $addName = $_POST['addName'];

    $query = "INSERT INTO categories (code, name) VALUES ('".$addCode."','".$addName."')";
    $statement = $connection->prepare($query);

    if($statement->execute()) {
      returnBooks();
    } else {
      echo "Something went wrong!";
    }
  }

  // Delete item on click of delete button
  if(isset($_POST['action']) && $_POST['action'] == 'delete') {
    $deleteId = $_POST['deleteId'];

    $query = "DELETE FROM categories WHERE id=$deleteId LIMIT 1";
    $statement = $connection->prepare($query);
    if($statement->execute()) {
      returnBooks();
    } else {
      echo "Something went wrong!";
    }
  }

  // Submit class on click of submit button after editing
  if(isset($_POST['action']) && $_POST['action'] == 'submit') {
    $newCode = $_POST['newCode'];
    $newName = $_POST['newName'];
    $submitId = $_POST['submitId'];

    $query = "UPDATE categories SET code = '$newCode', name = '$newName' WHERE id = $submitId LIMIT 1";
    $statement = $connection->prepare($query);

    if($statement->execute()) {
      returnBooks();
    } else {
      echo "Something went wrong!";
    }
  }
?>
