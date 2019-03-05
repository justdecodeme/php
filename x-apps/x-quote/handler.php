<?php
include '../includes/connect.php';


/******************************/
//       requests
/******************************/

// update list
if (isset($_GET['action']) && $_GET['action'] == 'updateList') {
    updateList($_GET['orderBy'], $_GET['ascOrDesc']);
}

// get today's quote
if (isset($_GET['action']) && $_GET['action'] == 'getTodaysQuote') {
  getTodaysQuote();
}

// set today's quote
if (isset($_POST['action']) && $_POST['action'] == 'setTodaysQuote') {
  $id = $_POST['id'];

  $query = "UPDATE `todays_quote_id` SET `id`=:ID";
  $statement = $connection->prepare($query);
  $statement->bindParam(":ID", $id);
  if ($statement->execute() && $statement->rowCount() == 1) {
    echo "quoteSet";
  } else {
    echo "queryError";
  }
}

// add
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $quoteInputValue = $_POST['quoteInputValue'];
    $authorInputValue = $_POST['authorInputValue'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    // first check if fields are empty
    if ($quoteInputValue == "" || $authorInputValue == "") {
        echo "emptyFields";
    } else {
        // Show error if already exist, otherwise add new
        $query = "SELECT * FROM quotes WHERE quote=:QUOTE";
        $statement = $connection->prepare($query);
        $statement->bindParam(':QUOTE', $quoteInputValue);

        if ($statement->execute() && $statement->rowCount() == 1) {
            echo "alreadyExist";
        } else {
            $query = "INSERT INTO `quotes`
                ( `quote`, `author`)
                VALUES
                (:QUOTE, :AUTHOR)";

            $statement = $connection->prepare($query);
            $params = array('QUOTE' => $quoteInputValue, 'AUTHOR' => $authorInputValue);

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

    if($id == getTodaysQuoteId()) {
      echo "cantDelete";
      return;
    }

    $query = "DELETE FROM quotes WHERE id=:ID LIMIT 1";
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
    $quoteInputValue = $_POST['quoteInputValue'];
    $authorInputValue = $_POST['authorInputValue'];

    $query = "UPDATE `quotes`
      SET
        `quote` = :QUOTE_VALUE,
        `author` = :AUTHOR_VALUE
      WHERE
        `id` = :ID
      LIMIT 1";

  $statement = $connection->prepare($query);
  $params = array(
      'ID' => $id,
      'QUOTE_VALUE' => $quoteInputValue,
      'AUTHOR_VALUE' => $authorInputValue,
  );
  // $statement->rowCount() == 1    if any changes are there
  // $statement->rowCount() == 0    if no changes are there
  if ($statement->execute($params)) {
    if($statement->rowCount() == 1) {
      updateList($orderBy, $ascOrDesc);
    }
  } else {
      echo "queryError";
  }
}


/******************************/
//       functions
/******************************/

function updateList($orderBy, $ascOrDesc) {
  $todaysQuoteId = getTodaysQuoteId();

  global $connection;

  $query = "SELECT * FROM quotes ORDER BY LOWER($orderBy) $ascOrDesc";

  $statement = $connection->prepare($query);

  if ($statement->execute()) {
      $list = '';
      $i = 1;

      $row = $statement->fetchAll(PDO::FETCH_OBJ);

      foreach ($row as $quote) {
        if($todaysQuoteId == $quote->id) {
          $list .= "<tr data-id='{$quote->id}' class='table-active'>";
        } else { $list .= "<tr data-id='{$quote->id}'>"; }
          $list .= "
      <th scope='row'>{$i}</th>
      <td data-column='quote'>{$quote->quote}</td>
      <td data-column='author'>{$quote->author}</td>
      <td>
        <button data-action='edit' type='button' class='btn btn-success primary'><i class='fas fa-edit'></i></button>
        <button data-action='delete' type='button' class='btn btn-danger primary'><i class='fas fa-trash-alt'></i></button>
        <button data-action='set' type='button' class='btn btn-primary primary' data-toggle='tooltip' data-placement='top' title=\"Make it today's Quote\"><i class='fas fa-clock'></i></button>
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

function getTodaysQuoteId() {
  global $connection;

  // get todays quote id
  $query = "SELECT id FROM `todays_quote_id` LIMIT 1";
  $statement = $connection->prepare($query);

  if ($statement->execute() && $statement->rowCount() == 1) {
    $row = $statement->fetch();
    return $row['id'];
  } else {
    return "queryError";
  }
}

function getTodaysQuote() {
  global $connection;
  $id = getTodaysQuoteId();

  // get quote information related to fetched 'id'
  $query = "SELECT * FROM `quotes` WHERE id = {$id}";
  $statement = $connection->prepare($query);
  if ($statement->execute() && $statement->rowCount() == 1) {
      $quoteRow = $statement->fetch();
      echo "
          <blockquote>
            <p>{$quoteRow['quote']}</p>
          </blockquote>
          <cite>– {$quoteRow['author']}</cite>
        ";

  } else {
      echo "queryError";
  }
}