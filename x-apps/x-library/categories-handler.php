<?php
include 'includes/connect.php';

function returnCategories()
{
    global $connection;
    $query = "SELECT * FROM categories ORDER BY category_code";
    $statement = $connection->prepare($query);
    if ($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        $categories_list = '';
        $i = 0;
        foreach ($row as $category) {
            $i++;
            if ($category->category_code !== 'default') {
                $categories_list .= "
          <tr>
            <td>$i</td>
            <td class='category-code'>$category->category_code</td>
            <td class='category-name'>$category->category_name</td>
            <td>
              <button type='button' class='btn btn-primary reading' data-id='$category->id' id='editBtn'><i class='fas fa-edit'></i></button>
              <button type='button' class='btn btn-danger reading' data-id='$category->id' id='deleteBtn'><i class='fas fa-trash-alt'></i></button>
              <button type='button' class='btn btn-success editing' data-id='$category->id' id='updateBtn'><i class='fas fa-check'></i></button>
              <button type='button' class='btn btn-primary editing' data-id='$category->id' id='cancelBtn'><i class='fas fa-times'></i></button>
            </td>
          </tr>
        ";
            } else {
                $categories_list .= "
          <tr>
            <td>$i</td>
            <td class='category-code'>$category->category_code</td>
            <td class='category-name'>$category->category_name</td>
            <td></td>
          </tr>
        ";

            }
        }
        echo $categories_list;
    } else {
        echo "Something went wrong!";
    }
}

// return categories list
if (isset($_GET['action']) && $_GET['action'] == 'fetchCategories') {
    returnCategories();
}

// add item on click of add button
if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $addCode = $_POST['addCode'];
    $addName = $_POST['addName'];

    $query = "INSERT INTO categories (category_code, category_name) VALUES ('" . $addCode . "','" . $addName . "')";
    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        returnCategories();
    } else {
        echo "Something went wrong!";
    }
}

// delete item on click of delete button
if (isset($_POST['action']) && $_POST['action'] == 'delete') {
    $deleteId = $_POST['deleteId'];

    $query = "DELETE FROM categories WHERE id=$deleteId LIMIT 1";
    $statement = $connection->prepare($query);
    if ($statement->execute()) {
        returnCategories();
    } else {
        echo "Something went wrong!";
    }
}

// update on click of update button after editing
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $newCode = $_POST['newCode'];
    $newName = $_POST['newName'];
    $updateId = $_POST['updateId'];

    $query = "UPDATE categories SET category_code = '$newCode', category_name = '$newName' WHERE id = $updateId LIMIT 1";
    $statement = $connection->prepare($query);

    if ($statement->execute()) {
        returnCategories();
    } else {
        echo "Something went wrong!";
    }
}
