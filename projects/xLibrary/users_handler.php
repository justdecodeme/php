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

function returnUsers() {
  global $connection;
  $query = "SELECT *  FROM users ORDER BY username";
  $statement = $connection->prepare($query);
  if($statement->execute()) {
    $row = $statement->fetchAll(PDO::FETCH_OBJ);
    $users_list = '';
    $i = 0;
    foreach($row as $user) {
      $i++;
      $users_list .= "
      <tr data-user-id='$user->id' data-user-access-type='$user->access_type'>
        <td>$i</td>
        <td class='user-username'>$user->username</td>
        <td class='user-fullname'>$user->full_name</td>
        <td class='user-email'>$user->email</td>
        <td class='user-image'>$user->image</td>
        <td class='user-access-type'>$user->access_type</td>
        <td>
          <button type='button' class='btn btn-primary reading' id='editBtn'><i class='fas fa-edit'></i></button>
          <button type='button' class='btn btn-danger reading' id='deleteBtn'><i class='fas fa-trash-alt'></i></button>
          <button type='button' class='btn btn-success editing' id='updateBtn'><i class='fas fa-check'></i></button>
          <button type='button' class='btn btn-primary editing' id='cancelBtn'><i class='fas fa-times'></i></button>
        </td>
      </tr>
      ";
    }
    echo $users_list;
  } else {
    echo "Something went wrong!";
  }
}

// return users list
if(isset($_GET['action']) && $_GET['action'] == 'fetchUsers') {
  returnUsers();
}

// return users list
if(isset($_GET['action']) && $_GET['action'] == 'fetchCategoriesForBooks') {
  fetchCategoriesForBooks();
}

// add item on click of add button
if(isset($_POST['action']) && $_POST['action'] == 'add') {
  $addUsername = $_POST['addUsername'];
  $addFullName = $_POST['addFullName'];
  $addEmail = $_POST['addEmail'];
  $addImage = $_POST['addImage'];
  $selectUserType = $_POST['selectUserType'];

  $query = "INSERT INTO users (username, full_name, email, image, access_type) VALUES ('".$addUsername."','".$addFullName."','".$addEmail."','".$addImage."','".$selectUserType."')";
  $statement = $connection->prepare($query);

  if($statement->execute()) {
    returnUsers();
  } else {
    echo "Something went wrong!";
  }
}

// delete item on click of delete button
if(isset($_POST['action']) && $_POST['action'] == 'delete') {
  $userId = $_POST['userId'];
  echo $userId;
  $query = "DELETE FROM users WHERE id = $userId LIMIT 1";
  $statement = $connection->prepare($query);
  if($statement->execute()) {
    returnUsers();
  } else {
    echo "Something went wrong!";
  }
}

// update on click of update button after editing
if(isset($_POST['action']) && $_POST['action'] == 'update') {
  $newUsername = $_POST['newUsername'];
  $newFullname = $_POST['newFullname'];
  $newEmail = $_POST['newEmail'];
  $newImage = $_POST['newImage'];
  $newAccessType = $_POST['newAccessType'];
  $userId = $_POST['userId'];

  $query = "UPDATE `users`
    SET
      `username` = :USERNAME,
      `full_name` = :FULLNAME,
      `email` = :EMAIL,
      `image` = :IMAGE,
      `access_type` = :ACCESS_TYPE
    WHERE
      `id` = :USERID
    LIMIT 1";

  $statement = $connection->prepare($query);
  $params = array ('USERNAME'=>$newUsername,'FULLNAME'=>$newFullname,'EMAIL'=>$newEmail,'IMAGE'=>$newImage, 'ACCESS_TYPE'=>$newAccessType, 'USERID'=>$userId);

  if($statement->execute($params)) {
    returnUsers();
  } else {
    echo "Something went wrong!";
  }
}
?>
