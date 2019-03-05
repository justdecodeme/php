<?php
include '../includes/connect.php';

/******************************/
//       requests
/******************************/

// return categories list for books
if (isset($_GET['action']) && $_GET['action'] == 'fetchRolesForUsers') {
    fetchRolesForUsers();
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
    $roleInputValue = $_POST['roleInputValue'];

    $roleInputValue = fetchRoleIdFromRoleCode($roleInputValue);

    $query = "UPDATE `users`
      SET
        `user_role_id` = :USER_ROLE_ID
      WHERE
        `id` = :ID
      LIMIT 1";

    $statement = $connection->prepare($query);
    $params = array(
        'ID' => $id,
        'USER_ROLE_ID' => $roleInputValue
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

function fetchRolesForUsers()
{
    global $connection;
    $query = "SELECT `role_code`, `role_name` FROM `roles` ORDER BY `role_name`";
    $statement = $connection->prepare($query);
    if ($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        $list = "<option value='all'>All</option>";
        foreach ($row as $role) {
            $list .= "<option value='{$role->role_code}'>{$role->role_name}</option>";
        }
        echo $list;
    } else {
        echo "queryError";
    }
}

function updateList($orderBy, $ascOrDesc)
{
    global $connection;

    $query = "SELECT u.id, u.user_name, u.user_email, u.user_role_id, u.user_gender, r.role_name as user_role_name, r.role_code as user_role_code
      FROM users u
      LEFT JOIN roles r
      ON u.user_role_id = r.id
      ORDER BY LOWER($orderBy) $ascOrDesc";

    // $query = "SELECT * FROM `users` ORDER BY LOWER($orderBy) $ascOrDesc";

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
            <td data-column='role' data-code='{$user->user_role_code}'>{$user->user_role_name}</td>
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

function fetchRoleIdFromRoleCode($role_code)
{
  global $connection;
  $query = "SELECT `id` FROM `roles` WHERE `role_code`=:ROLE_CODE LIMIT 1";
  $statement = $connection->prepare($query);
  $statement->bindParam(":ROLE_CODE", $role_code);


  if ($statement->execute() && $statement->rowCount() == 1) {
      $row = $statement->fetch();
      return $row['id'];
  } else {
      return "queryError";
  }

}
