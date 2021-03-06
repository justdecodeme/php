<?php
include 'includes/connect.php';

function fetchCategoriesForBooks() {
  global $connection;
  $query = "SELECT * FROM categories ORDER BY category_code";
  $statement = $connection->prepare($query);
  if($statement->execute()) {
    $row = $statement->fetchAll(PDO::FETCH_OBJ);
    $categories_list = '';
    foreach($row as $category) {
      // mark 'uncategorised' option selected by default
      if($category->category_code == 'default') {
        $categories_list .= "<option value='$category->id' selected>$category->category_name</option>";
      } else {
        $categories_list .= "<option value='$category->id'>$category->category_name</option>";
      }
    }
    echo $categories_list;
  } else {
    echo "Something went wrong!";
  }
}

function returnBooks() {
  global $connection;
  $query = "SELECT books.id as bookId, title, author, stock, category_id as categoryId, category_code, category_name  FROM books LEFT JOIN categories ON books.category_id = categories.id ORDER BY title";
  // $query = "SELECT * FROM books ORDER BY title";
  $statement = $connection->prepare($query);
  if($statement->execute()) {
    $row = $statement->fetchAll(PDO::FETCH_OBJ);
    $books_list = '';
    $i = 0;
    foreach($row as $book) {
      $i++;
      $books_list .= "
      <tr data-book-id='$book->bookId' data-category-id='$book->categoryId'>
        <td>$i</td>
        <td class='book-title'>$book->title</td>
        <td class='book-author'>$book->author</td>
        <td class='book-stock'>$book->stock</td>
        <td class='book-category'>$book->category_name</td>
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

// return books list
if(isset($_GET['action']) && $_GET['action'] == 'fetchCategoriesForBooks') {
  fetchCategoriesForBooks();
}

// add item on click of add button
if(isset($_POST['action']) && $_POST['action'] == 'add') {
  $addTitle = $_POST['addTitle'];
  $addAuthor = $_POST['addAuthor'];
  $addStock = $_POST['addStock'];
  $addCategory = $_POST['addCategory'];

  $query = "INSERT INTO books (title, author, stock, category_id) VALUES ('".$addTitle."','".$addAuthor."','".$addStock."','".$addCategory."')";
  $statement = $connection->prepare($query);

  if($statement->execute()) {
    returnBooks();
  } else {
    echo "Something went wrong!";
  }
}

// delete item on click of delete button
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
  $newCategory = $_POST['newCategory'];
  $bookId = $_POST['bookId'];

  $query = "UPDATE `books`
    SET
      `title` = :TITLE,
      `author` = :AUTHOR,
      `stock` = :STOCK,
      `category_id` = :CATEGORY
    WHERE
      `id` = :BOOKID
    LIMIT 1";
    
  $statement = $connection->prepare($query);
  $params = array ('TITLE'=>$newTitle,'AUTHOR'=>$newAuthor,'STOCK'=>$newStock,'CATEGORY'=>$newCategory, 'BOOKID'=>$bookId);

  if($statement->execute($params)) {
    returnBooks();
  } else {
    echo "Something went wrong!";
  }
}
?>
