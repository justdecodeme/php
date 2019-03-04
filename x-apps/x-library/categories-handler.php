<?php
include '../includes/connect.php';

/******************************/
//       requests
/******************************/

// update list
if (isset($_GET['action']) && $_GET['action'] == 'updateList') {
    updateList($_GET['orderBy'], $_GET['ascOrDesc']);
}

// add
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $categoryInputValue = $_POST['categoryInputValue'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    // first check if fields are empty
    if ($categoryInputValue == "") {
        echo "emptyFields";
    } else {
        // Show error if already exist, otherwise add new
        $query = "SELECT * FROM `categories` WHERE category_name=:CATEGORY_NAME";
        $statement = $connection->prepare($query);
        $statement->bindParam(':CATEGORY_NAME', $categoryInputValue);

        if ($statement->execute() && $statement->rowCount() == 1) {
            echo "alreadyExist";
        } else {
            $query = "INSERT INTO `categories`
                ( `category_name`)
                VALUES
                (:CATEGORY_NAME)";

            $statement = $connection->prepare($query);
            $params = array('CATEGORY_NAME' => $categoryInputValue);

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

    $query = "DELETE FROM `categories` WHERE id=:ID LIMIT 1";
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
    $categoryInputValue = $_POST['categoryInputValue'];

    $query = "UPDATE `categories`
      SET
        `category_name` = :CATEGORY_NAME
      WHERE
        `id` = :ID
      LIMIT 1";

    $statement = $connection->prepare($query);
    $params = array(
        'ID' => $id,
        'CATEGORY_NAME' => $categoryInputValue,
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

function updateList($orderBy, $ascOrDesc)
{
    global $connection;

    $query = "SELECT * FROM `categories` ORDER BY $orderBy $ascOrDesc";

    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        $list = '';
        $i = 1;

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($row as $category) {
            $list .= "
            <tr data-id='{$category->id}'>
            <th scope='row'>{$i}</th>
            <td data-column='category'>{$category->category_name}</td>
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