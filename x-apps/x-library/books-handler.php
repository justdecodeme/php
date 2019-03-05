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

// add
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $titleInputValue = $_POST['titleInputValue'];
    $authorInputValue = $_POST['authorInputValue'];
    $stockInputValue = $_POST['stockInputValue'];
    $categoryInputValue = $_POST['categoryInputValue'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    // first check if fields are empty
    if ($titleInputValue == "" || $authorInputValue == "" || $stockInputValue == "" ) {
        echo "emptyFields";
    } else {
        // Show error if already exist, otherwise add new
        $query = "SELECT `id` FROM `books` WHERE book_title=:BOOK_TITLE";
        $statement = $connection->prepare($query);
        $statement->bindParam(':BOOK_TITLE', $titleInputValue);

        if ($statement->execute() && $statement->rowCount() == 1) {
            echo "alreadyExist";
        } else {
            $query = "INSERT INTO `books`
                ( `book_title`, `book_author`, `book_stock`, `category_id`)
                VALUES
                (:BOOK_TITLE, :BOOK_AUTHOR, :BOOK_STOCK, :CATEGORY_ID)";

            $statement = $connection->prepare($query);
            $params = array('BOOK_TITLE' => $titleInputValue, 'BOOK_AUTHOR' => $authorInputValue, 'BOOK_STOCK' => $stockInputValue, 'CATEGORY_ID' => $categoryInputValue);

            // Update list if query is successful
            if ($statement->execute($params)) {
                updateList($orderBy, $ascOrDesc);
            } else {
                echo "queryError";
            }
        }
    }

}

// delete
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $id = $_POST['id'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    $query = "DELETE FROM `books` WHERE id=:ID LIMIT 1";
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
          $list .= "<option value='$category->id'>$category->category_name</option>";
        }
        echo $list;
    } else {
        echo "queryError";
    }
}


function updateList($orderBy, $ascOrDesc)
{
    global $connection;

    $query = "SELECT b.id, b.book_title, b.book_author, b.book_stock, c.category_name, c.id as category_id
      FROM books b 
      INNER JOIN categories c 
      ON b.category_id = c.id 
      ORDER BY $orderBy $ascOrDesc";
    // $query = "SELECT * FROM `books` ORDER BY $orderBy $ascOrDesc";

    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        $list = '';
        $i = 1;

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($row as $book) {
            $list .= "
            <tr data-id='{$book->id}'>
            <th scope='row'>{$i}</th>
            <td data-column='title'>{$book->book_title}</td>
            <td data-column='author'>{$book->book_author}</td>
            <td data-column='stock'>{$book->book_stock}</td>
            <td data-column='category' data-id='{$book->category_id}'>{$book->category_name}</td>
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