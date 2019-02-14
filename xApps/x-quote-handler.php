<?php
include 'includes/connect.php';

function updateList($orderBy, $ascOrDesc)
{
    global $connection;

    $query = "SELECT * FROM quotes ORDER BY $orderBy $ascOrDesc";

    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        $list = '';
        $i = 1;

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($row as $quote) {
            $list .= "
      <tr data-id='{$quote->id}'>
        <th scope='row'>{$i}</th>
        <td>{$quote->quote}</td>
        <td>{$quote->author}</td>
        <td>
          <button data-action='edit' type='button' class='btn btn-success'><i class='far fa-edit'></i></button>
          <button data-action='delete' type='button' class='btn btn-danger'><i class='far fa-trash-alt'></i></button>
          <button data-action='set' type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title=\"Make it today's Quote\"><i class='far fa-clock'></i></button>
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

// update list
if (isset($_GET['action']) && $_GET['action'] == 'updateList') {
    updateList($_GET['orderBy'], $_GET['ascOrDesc']);
}

// add
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $quoteInputValue = $_POST['quoteInputValue'];
    $authorInputValue = $_POST['authorInputValue'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    // Show error if `quote` already exist
    // otherwise add new `quote`
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

        // Update quotes list if query is successful
        if ($statement->execute($params)) {
            updateList($orderBy, $ascOrDesc);
        } else {
            echo "queryError";
        }
    }

}
