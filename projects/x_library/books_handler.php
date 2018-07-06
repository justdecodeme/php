<?php
  include 'includes/connect.php';

  function returnBooks() {
    global $connection;
    $query = "SELECT * FROM books LEFT JOIN categories ON books.category_id = categories.id ORDER BY title";
    // $query = "SELECT * FROM books ORDER BY title";
    $statement = $connection->prepare($query);
    if($statement->execute()) {
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      $books_list = '';
      $i = 0;
      foreach($row as $book) {
        $i++;
        $books_list .= "
        <tr data-id='$book->id'>
          <td>$i</td>
          <td class='book-title'>$book->title</td>
          <td class='book-author'>$book->author</td>
          <td class='book-stock'>$book->stock</td>
          <td class='book-category'>$book->name</td>
          <td>
            <button type='button' class='btn btn-primary reading' id='editBtn'><i class='fas fa-edit'></i></button>
            <button type='button' class='btn btn-danger reading' id='deleteBtn'><i class='fas fa-trash-alt'></i></button>
            <button type='button' class='btn btn-success editing' id='updateBtn'><i class='fas fa-check'></i></button>
            <button type='button' class='btn btn-primary editing' id='cancelBtn'><i class='fas fa-times'></i></button>
          </td>
        </tr>
        ";
      }
      echo $books_list;
    } else {
      echo "Something went wrong!";
    }
  }

  // return books list
  if(isset($_GET['action']) && $_GET['action'] == 'fetchBooks') {
    returnBooks();
  }

  // Add book on click of add button
  if(isset($_POST['action']) && $_POST['action'] == 'add') {
    $addTitle = $_POST['addTitle'];
    $addAuthor = $_POST['addAuthor'];
    $addStock = $_POST['addStock'];

    $query = "INSERT INTO books (title, author, stock) VALUES ('".$addTitle."','".$addAuthor."','".$addStock."')";
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

    $query = "DELETE FROM books WHERE id=$deleteId LIMIT 1";
    $statement = $connection->prepare($query);
    if($statement->execute()) {
      returnBooks();
    } else {
      echo "Something went wrong!";
    }
  }

  // update on click of update button after editing
  if(isset($_POST['action']) && $_POST['action'] == 'update') {
    $newTitle = $_POST['newTitle'];
    $newAuthor = $_POST['newAuthor'];
    $newStock = $_POST['newStock'];
    $updateId = $_POST['updateId'];

    $query = "UPDATE books SET title = '$newTitle', author = '$newAuthor', stock = '$newStock' WHERE id = $updateId LIMIT 1";
    $statement = $connection->prepare($query);

    if($statement->execute()) {
      returnBooks();
    } else {
      echo "Something went wrong!";
    }
  }
?>
