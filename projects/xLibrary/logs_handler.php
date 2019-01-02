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

function returnLogs() {
  global $connection;
  $query = "SELECT l.id as logId, full_name, title, issue_date, due_date, approved_by_id, return_date, confirmed_by_id, status
    FROM logs l
    INNER JOIN books b
      on l.book_id = b.id
    INNER JOIN users u
      on l.user_id = u.id
    ORDER BY issue_date;
  ";
  $statement = $connection->prepare($query);
  if($statement->execute()) {
    $row = $statement->fetchAll(PDO::FETCH_OBJ);
    $logs_list = '';
    $i = 0;
    foreach($row as $log) {

      // select apprved by full name
      $query = "SELECT full_name FROM users WHERE id=$log->approved_by_id";
      $statement = $connection->prepare($query);
      $approved_by_full_name = '';
      if($statement->execute()) {
        $users = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach($users as $user) {
          $approved_by_full_name = $user->full_name;
        }
      }
      // select confirmed by full name
      $query = "SELECT full_name FROM users WHERE id=$log->confirmed_by_id";
      $statement = $connection->prepare($query);
      $confirmed_by_full_name = '';
      if($statement->execute()) {
        $users = $statement->fetchAll(PDO::FETCH_OBJ);
        foreach($users as $user) {
          $confirmed_by_full_name = $user->full_name;
        }
      }

      $i++;
      $logs_list .= "
      <tr data-log-id='$log->logId'>
        <td>$log->full_name</td>
        <td>$log->title</td>
        <td>".date('j-M-Y', strtotime($log->issue_date))."</td>
        <td>".date('j-M-Y', strtotime($log->due_date))."</td>
        <td>$approved_by_full_name</td>
        <td>".date('j-M-Y', strtotime($log->return_date))."</td>
        <td>$confirmed_by_full_name</td>
        <td>
          <button type='button' class='btn btn-success btn-block' disabled>Returned</button>
        </td>
      </tr>
      ";
    }
    echo $logs_list;
  } else {
    echo "Something went wrong!";
  }
}

// return books list
if(isset($_GET['action']) && $_GET['action'] == 'fetchLogs') {
  returnLogs();
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
    returnLogs();
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
    returnLogs();
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
    returnLogs();
  } else {
    echo "Something went wrong!";
  }
}
?>
