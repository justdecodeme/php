<?php
include '../includes/connect.php';

/******************************/
//       requests
/******************************/

// return categories list for books
if (isset($_GET['action']) && $_GET['action'] == 'fetchCategoriesForBooks') {
    fetchCategoriesForBooks();
}

// update list
if (isset($_GET['action']) && $_GET['action'] == 'updateList') {
    updateList($_GET['orderBy'], $_GET['ascOrDesc']);
}

// delete
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    $query = "DELETE FROM `users` WHERE id=:ID LIMIT 1";
    $statement = $connection->prepare($query);
    $statement->bindParam(":ID", $id);
    if ($statement->execute()) {
        updateList($orderBy, $ascOrDesc);
    } else {
        echo "queryError";
    }
}

// submit
if (isset($_POST['action']) && $_POST['action'] == 'submit') {
    $id = $_POST['id'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];
    $titleInputValue = $_POST['titleInputValue'];
    $authorInputValue = $_POST['authorInputValue'];
    $stockInputValue = $_POST['stockInputValue'];
    $categoryInputValue = $_POST['categoryInputValue'];

    $query = "UPDATE `books`
      SET
        `book_title` = :BOOK_TITLE,
        `book_author` = :BOOK_AUTHOR,
        `book_stock` = :BOOK_STOCK,
        `category_id` = :CATEGORY_ID
      WHERE
        `id` = :ID
      LIMIT 1";

    $statement = $connection->prepare($query);
    $params = array(
        'ID' => $id,
        'BOOK_TITLE' => $titleInputValue,
        'BOOK_AUTHOR' => $authorInputValue,
        'BOOK_STOCK' => $stockInputValue,
        'CATEGORY_ID' => $categoryInputValue,
    );
    // $statement->rowCount() == 1    if any changes are there
    // $statement->rowCount() == 0    if no changes are there
    if ($statement->execute($params)) {
        if ($statement->rowCount() == 1) {
            updateList($orderBy, $ascOrDesc);
        }
    } else {
        echo "queryError";
    }
}

/******************************/
//       functions
/******************************/

function fetchCategoriesForBooks()
{
    global $connection;
    $query = "SELECT * FROM `categories` ORDER BY `category_name`";
    $statement = $connection->prepare($query);
    if ($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        $list = '';
        foreach ($row as $category) {
            $isSelected = $category->id == 1 ? "selected" : "";
            $list .= "<option value='{$category->id}' {$isSelected}>{$category->category_name}</option>";
        }
        echo $list;
    } else {
        echo "queryError";
    }
}

function updateList($orderBy, $ascOrDesc)
{
    global $connection;

    $query = "SELECT *
      FROM users
      ORDER BY LOWER($orderBy) $ascOrDesc";
    // $query = "SELECT * FROM `books` ORDER BY $orderBy $ascOrDesc";

    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        $list = '';
        $i = 1;

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($row as $user) {
            $list .= "
            <tr data-id='{$user->id}'>
            <th scope='row'>{$i}</th>
            <td data-column='name'>{$user->user_name}</td>
            <td data-column='email'>{$user->user_email}</td>
            <td data-column='role'>{$user->user_role}</td>
            <td data-column='gender'>{$user->user_gender}</td>
            <td>
              <button data-action='edit' type='button' class='btn btn-success primary'><i class='fas fa-edit'></i></button>
              <button data-action='delete' type='button' class='btn btn-danger primary'><i class='fas fa-trash-alt'></i></button>
              <button data-action='cancel' type='button' class='btn btn-primary secondary' data-toggle='tooltip' data-placement='top'><i class='fas fa-times'></i></button>
              <button data-action='submit' type='button' class='btn btn-primary secondary' data-toggle='tooltip' data-placement='top'><i class='fas fa-check'></i></button>
            </td>
          </tr>
          ";
            $i++;
        }
        echo $list;
    } else {
        echo "queryError";
    }
}
