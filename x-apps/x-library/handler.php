<?php
$rootPath = $_SERVER['DOCUMENT_ROOT'] . '/php/x-apps/';

include $rootPath . 'includes/init.php';
include $rootPath . 'includes/connect.php';

/******************************/
//       requests
/******************************/

// return list
if (isset($_GET['action']) && $_GET['action'] == 'fetchBorrowersList') {
    fetchBorrowersList();
}
if (isset($_GET['action']) && $_GET['action'] == 'fetchAdminsList') {
    fetchAdminsList();
}
if (isset($_GET['action']) && $_GET['action'] == 'fetchBookCategoriesList') {
    fetchBookCategoriesList();
}
if (isset($_GET['action']) && $_GET['action'] == 'fetchBooksList') {
    fetchBooksList($_GET['book_category_id']);
}

// update list
if (isset($_GET['action']) && $_GET['action'] == 'updateList') {
    updateList($_GET['orderBy'], $_GET['ascOrDesc']);
}

// add
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $borrowerSelectValue = $_POST['borrowerSelectValue'];
    $bookSelectValue = $_POST['bookSelectValue'];
    $issueDateInputValue = $_POST['issueDateInputValue'];
    $dueDateInputValue = $_POST['dueDateInputValue'];
    $approvedBySelectValue = $_POST['approvedBySelectValue'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    // first check if fields are empty
    if ($bookSelectValue == "" || $issueDateInputValue == "" || $dueDateInputValue == "") {
        echo "emptyFields";
    } else {
        // Show error if already exist, otherwise add new
        $query = "SELECT `id` FROM `library` WHERE library_user_id=:LIBRARY_USER_ID AND library_book_id=:LIBRARY_BOOK_ID";
        $statement = $connection->prepare($query);
        $statement->bindParam(':LIBRARY_USER_ID', $borrowerSelectValue);
        $statement->bindParam(':LIBRARY_BOOK_ID', $bookSelectValue);

        if ($statement->execute() && $statement->rowCount() == 1) {
            echo "alreadyExist";
        } else {
            $query = "INSERT INTO `library`
                ( `library_user_id`, `library_book_id`, `library_issue_date`, `library_due_date`, `library_approved_by_user_id`)
                VALUES
                (:LIBRARY_USER_ID, :LIBRARY_BOOK_ID, :LIBRARY_ISSUE_DATE, :LIBRARY_DUE_DATE, :LIBRARY_APPROVED_ID)";

            $statement = $connection->prepare($query);
            $params = array('LIBRARY_USER_ID' => $borrowerSelectValue, 'LIBRARY_BOOK_ID' => $bookSelectValue, 'LIBRARY_ISSUE_DATE' => $issueDateInputValue, 'LIBRARY_DUE_DATE' => $dueDateInputValue, 'LIBRARY_APPROVED_ID' => $approvedBySelectValue);

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

    $query = "DELETE FROM `library` WHERE id=:ID LIMIT 1";
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
    $borrowElValue = $_POST['borrowElValue'];
    $bookElValue = $_POST['bookElValue'];
    $approveElValue = $_POST['approveElValue'];
    $issueDateElValue = $_POST['issueDateElValue'];
    $dueDateElValue = $_POST['dueDateElValue'];
    // var_dump($id, $borrowElValue, $bookElValue, $approveElValue, $issueDateElValue, $dueDateElValue);
    $query = "UPDATE `library`
      SET
        `library_user_id`=:LIBRARY_USER_ID,
        `library_book_id`=:LIBRARY_BOOK_ID,
        `library_approved_by_user_id`=:LIBRARY_APPROVED_BY_USER_ID,
        `library_issue_date`=:LIBRARY_ISSUE_DATE,
        `library_due_date`=:LIBRARY_DUE_DATE
      WHERE
        `id`=:ID
      LIMIT 1";

    $statement = $connection->prepare($query);
    $params = array(
        'ID' => $id,
        'LIBRARY_USER_ID' => $borrowElValue,
        'LIBRARY_BOOK_ID' => $bookElValue,
        'LIBRARY_APPROVED_BY_USER_ID' => $approveElValue,
        'LIBRARY_ISSUE_DATE' => $issueDateElValue,
        'LIBRARY_DUE_DATE' => $dueDateElValue
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

function fetchBorrowersList()
{
    global $connection;
    $query = "SELECT u.id, u.user_f_name, u.user_l_name, r.role_code
      FROM users u
      LEFT JOIN roles r
      ON u.user_role_id = r.id
      WHERE
        r.role_code='em'
      ORDER BY LOWER(u.user_f_name) ASC";
    
    // $query = "SELECT * FROM `users` ORDER BY `user_name` WHERE ";
    $statement = $connection->prepare($query);
    // $statement->bindParam(':ROLE_CODE', 'em');

    if ($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        $list = '';
        foreach ($row as $user) {
            $list .= "<option value='{$user->id}'>{$user->user_f_name} {$user->user_l_name}</option>";
        }
        echo $list;
    } else {
        echo "queryError";
    }
}
function fetchAdminsList()
{
    global $connection;
    $query = "SELECT u.id, u.user_name, u.user_f_name, u.user_l_name
      FROM users u
      LEFT JOIN roles r
      ON u.user_role_id = r.id
      WHERE
        r.role_code='ad'
      ORDER BY LOWER(u.user_f_name) ASC";
    
    // $query = "SELECT * FROM `users` ORDER BY `user_name` WHERE ";
    $statement = $connection->prepare($query);
    // $statement->bindParam(':ROLE_CODE', 'em');

    if ($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        $list = '';
        foreach ($row as $user) {
          $isSelected = $user->user_name == $_SESSION['user_name'] ? 'selected' : '';
          $list .= "<option value='{$user->id}' {$isSelected}>{$user->user_f_name} {$user->user_l_name}</option>";
        }
        echo $list;
    } else {
        echo "queryError";
    }
}

// return admin list to confirm return of books
function fetchConfirmedByList()
{
    global $connection;
    $query = "SELECT u.id, u.user_name, u.user_f_name, u.user_l_name
      FROM users u
      LEFT JOIN roles r
      ON u.user_role_id = r.id
      WHERE
        r.role_code='ad'
      ORDER BY LOWER(u.user_f_name) ASC";
    
    $statement = $connection->prepare($query);
    // $statement->bindParam(':ROLE_CODE', 'em');

    if ($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        
        $list = '<select class="custom-select my-1">';
        foreach ($row as $user) {
          $isSelected = $user->user_name == $_SESSION['user_name'] ? 'selected' : '';
          $list .= "<option value='{$user->id}' {$isSelected}>{$user->user_f_name} {$user->user_l_name}</option>";
        }
        $list .= '</select>';
        return $list;
    } else {
        return "queryError";
    }
}
function fetchBookCategoriesList()
{
    global $connection;
    // $query = "SELECT u.id, u.user_f_name, u.user_l_name, r.role_code
    //   FROM users u
    //   LEFT JOIN roles r
    //   ON u.user_role_id = r.id
    //   WHERE
    //     r.role_code='em'
    //   ORDER BY LOWER(u.user_f_name) ASC";
    
    $query = "SELECT `id`, `category_name` FROM `categories` ORDER BY `category_name`";
    $statement = $connection->prepare($query);
    // $statement->bindParam(':ROLE_CODE', 'em');

    if ($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        $list = "<option value='all'>All</option>";
        foreach ($row as $category) {
            $list .= "<option value='{$category->id}'>{$category->category_name}</option>";
        }
        echo $list;
    } else {
        echo "queryError";
    }
}
function fetchBooksList($book_category_id)
{
    global $connection;
    if($book_category_id !== "" && $book_category_id !== "all") {
      $query = "SELECT b.id, CONCAT(b.book_title, ' - ', b.book_author) AS book
        FROM books b
        LEFT JOIN categories c
        ON b.book_category_id = c.id
        WHERE
          b.book_category_id =:BOOK_CATEGORY_ID
        ORDER BY LOWER(book) ASC";
    } else {
      $query = "SELECT `id`, CONCAT(b.book_title, ' - ', b.book_author) AS book FROM books b ORDER BY LOWER(book) ASC";
    }
    
    $statement = $connection->prepare($query);
    $statement->bindParam(':BOOK_CATEGORY_ID', $book_category_id);

    if ($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        if($statement->rowCount() == 0) {
          echo "NA";
          return;
        } else {
          $list = "";
          foreach ($row as $book) {
              $list .= "<option value='{$book->id}'>{$book->book}</option>";
          }
          echo $list;
        }
    } else {
        echo "queryError";
    }
}

function updateList($orderBy, $ascOrDesc)
{
    global $connection;
    $admin_list = fetchConfirmedByList();

    $query = "SELECT 
      l.id, l.library_user_id, l.library_book_id, l.library_approved_by_user_id, l.library_confirmed_by_user_id,
      l.library_issue_date AS issue_date, 
      l.library_due_date AS due_date, 
      l.library_return_date AS return_date, 
      CONCAT(u1.user_f_name, ' ', u1.user_l_name) AS borrowed_by,
      CONCAT(u2.user_f_name, ' ', u2.user_l_name) AS approved_by,
      CONCAT(u3.user_f_name, ' ', u3.user_l_name) AS confirmed_by,
      CONCAT(b.book_title, ' - ', b.book_author) AS book,
      c.category_name, b.book_category_id
      FROM library l
      LEFT JOIN users u1 ON l.library_user_id=u1.id
      LEFT JOIN users u2 ON l.library_approved_by_user_id=u2.id
      LEFT JOIN users u3 ON l.library_confirmed_by_user_id=u3.id
      LEFT JOIN books b ON l.library_book_id = b.id
      LEFT JOIN categories c ON b.book_category_id = c.id
      ORDER BY LOWER($orderBy) $ascOrDesc";

    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        $list = '';
        $i = 1;

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($row as $library) {
            $issue_date_attr = date('Y-m-d', strtotime($library->issue_date));
            $issue_date = date('d-M-Y', strtotime($library->issue_date));

            $due_date_attr = date('Y-m-d', strtotime($library->due_date));
            $due_date = date('d-M-Y', strtotime($library->due_date));

            $return_date_attr = date('Y-m-d', strtotime($library->return_date));
            $return_date = date('d-M-Y', strtotime($library->return_date));

            $currentDate = date('Y-m-d', time());
            $isReturned = is_null($library->return_date) ? "<input type='date' class='form-control' value='{$currentDate}'>" : $return_date;
            // $isReturned = is_null($library->return_date) ? "..." : $return_date;

            $isConfirmed = is_null($library->confirmed_by) ? $admin_list : $library->confirmed_by;
            // $isConfirmed = is_null($library->confirmed_by) ? '...' : $library->confirmed_by;

            $list .= "

            <tr data-id='{$library->id}'>
            <th scope='row'>{$i}</th>
            <td data-column='borrow' data-value='{$library->library_user_id}'>{$library->borrowed_by}</td>
            <td data-column='book' data-value='{$library->library_book_id}'>{$library->book}</td>
            <td data-column='category' data-value='{$library->book_category_id}'>{$library->category_name}</td>
            <td data-column='issue_date' data-value='{$issue_date_attr}'>{$issue_date}</td>
            <td data-column='due_date' data-value='{$due_date_attr}'>{$due_date}</td>
            <td data-column='approve' data-value='{$library->library_approved_by_user_id}'>{$library->approved_by}</td>
            <td data-column='return_date' data-value='{$return_date_attr}'>{$isReturned}</td>
            <td data-column='confirm' data-value='{$library->library_confirmed_by_user_id}'>{$isConfirmed}</td>
            <td class='action-btns'>

              <div class='btn-group primary' role='group' aria-label='Button group with nested dropdown'>
                <button type='button' class='btn btn-warning'>Confirm</button>
                <div class='btn-group' role='group'>
                  <button id='btnGroupDrop1' type='button' class='btn btn-light dropdown-toggle' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'></button>
                  <div class='dropdown-menu' aria-labelledby='btnGroupDrop1'>
                    <div class='btn-group' role='group' aria-label='First group'>
                      <button data-action='edit' type='button' class='btn btn-success primary'><i class='fas fa-edit'></i></button>
                      <button data-action='delete' type='button' class='btn btn-danger primary'><i class='fas fa-trash-alt'></i></button>
                    </div>
                  </div>
                </div>
              </div>
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
