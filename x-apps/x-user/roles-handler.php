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
    $codeInputValue = $_POST['codeInputValue'];
    $roleInputValue = $_POST['roleInputValue'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    // first check if fields are empty
    if ($codeInputValue == "" || $roleInputValue == "") {
        echo "emptyFields";
    } else {
        // Show error if already exist, otherwise add new
        $query = "SELECT * FROM `roles` WHERE role_code=:ROLE_CODE OR role_name=:ROLE_NAME";
        $statement = $connection->prepare($query);
        $statement->bindParam(':ROLE_CODE', $codeInputValue);
        $statement->bindParam(':ROLE_NAME', $roleInputValue);

        if ($statement->execute() && $statement->rowCount() == 1) {
            echo "alreadyExist";
        } else {
            $query = "INSERT INTO `roles`
                ( `role_code`, `role_name`)
                VALUES
                (:ROLE_CODE, :ROLE_NAME)";

            $statement = $connection->prepare($query);
            $params = array('ROLE_CODE' => $codeInputValue, 'ROLE_NAME' => $roleInputValue);

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

    if ($id == 6) {
        echo "cantDelete";
        return;
    }

    // to check if role to be deleted is already used or not
    $query = "SELECT COUNT(*) FROM roles r INNER JOIN users u ON r.id = u.user_role_id WHERE r.id = :ID GROUP BY r.id";
    $statement = $connection->prepare($query);
    $statement->bindParam(":ID", $id);

    if ($statement->execute()) {
        $number_of_rows = $statement->fetchColumn();
        if ($number_of_rows > 0) {
            echo "isUsedAtOtherPlace";
            return false;
        }
    } else {
        echo "queryError";
    }

    $query = "DELETE FROM `roles` WHERE id=:ID LIMIT 1";
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
    $roleInputValue = $_POST['roleInputValue'];
    $codeInputValue = $_POST['codeInputValue'];

    $query = "UPDATE `roles`
      SET
        `role_name` = :ROLE_NAME,
        `role_code` = :ROLE_CODE
      WHERE
        `id` = :ID
      LIMIT 1";

    $statement = $connection->prepare($query);
    $params = array(
        'ID' => $id,
        'ROLE_NAME' => $roleInputValue,
        'ROLE_CODE' => $codeInputValue
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

    $query = "SELECT * FROM `roles` ORDER BY LOWER($orderBy) $ascOrDesc";

    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        $list = '';
        $i = 1;

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($row as $role) {
            $isDisabled = $role->role_code == 'sb' ? "d-none" : "";
            $list .= "
            <tr data-id='{$role->id}'>
            <th scope='row'>{$i}</th>
            <td data-column='role'>{$role->role_name}</td>
            <td data-column='code'>{$role->role_code}</td>
            <td>
              <button data-action='edit' type='button' class='btn btn-success primary'><i class='fas fa-edit'></i></button>
              <button data-action='delete' type='button' class='btn btn-danger primary {$isDisabled}'><i class='fas fa-trash-alt'></i></button>
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
