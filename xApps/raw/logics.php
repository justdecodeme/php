<?php
// Add "quotes" and "authors" from json file.

$str = file_get_contents('_assets/js/quotes.json');
$quotes = json_decode($str, true); // decode the JSON into an associative array
foreach ($quotes as $quote) {
    foreach ($quote as $q) {

        // Show error if `quote` already exist
        // otherwise add new `quote`
        $query = "SELECT * FROM quotes WHERE quote=:QUOTE";
        $statement = $connection->prepare($query);
        $statement->bindParam(':QUOTE', $q["quote"]);

        if ($statement->execute() && $statement->rowCount() == 1) {
            echo "
        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
          <strong>Duplicate entry!</strong> {$q["quote"]} | {$q["author"]}
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button>
        </div>
      ";
        } else {
            $query = "INSERT INTO `quotes`
          ( `quote`, `author`)
          VALUES
          (:QUOTE, :AUTHOR)";

            $statement = $connection->prepare($query);
            $params = array('QUOTE' => $q["quote"], 'AUTHOR' => $q["author"]);

            // Update quotes list if query is successful
            if ($statement->execute($params)) {
                echo "Added";
            } else {
                echo "Querry is not successful!";
            }
        }

    }
}
