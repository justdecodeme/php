<?php
include 'includes/connect.php';

function updateQuotesList($orderBy, $ascOrDesc)
{
    global $connection;

    $query = "SELECT * FROM quotes ORDER BY $orderBy $ascOrDesc";

    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        $quotesList = '';
        $i = 1;

        $row = $statement->fetchAll(PDO::FETCH_OBJ);

        foreach ($row as $quote) {
            $quotesList .= "
      <tr data-id='{$quote->id}'>
        <th scope='row'>{$i}</th>
        <td>{$quote->quote}</td>
        <td>{$quote->author}</td>
        <td>
          <button type='button' class='btn btn-success'><i class='far fa-edit'></i></button>
          <button type='button' class='btn btn-danger'><i class='far fa-trash-alt'></i></button>
          <button type='button' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title=\"Make it today's Quote\"><i class='far fa-clock'></i></button>
        </td>
      </tr>
      ";
            $i++;
        }
        echo $quotesList;
    } else {
        echo "queryError";
    }
}

// update quotes list
if (isset($_GET['action']) && $_GET['action'] == 'updateQuotesList') {
    updateQuotesList($_GET['orderBy'], $_GET['ascOrDesc']);
}

// add quote
if (isset($_POST['action']) && $_POST['action'] == 'addQuote') {
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
      //   echo "
      //   <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
      //     <strong>This quote already exist!</strong>
      //     <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      //       <span aria-hidden=\"true\">&times;</span>
      //     </button>
      //   </div>
      // ";
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
            updateQuotesList($orderBy, $ascOrDesc);
        } else {
            echo "queryError";
        }
    }

}
