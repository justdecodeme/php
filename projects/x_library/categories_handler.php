<?php
  include 'includes/connect.php';

  function returnCategories() {
    global $connection;
    $query = "SELECT * FROM categories ORDER BY code";
    $statement = $connection->prepare($query);
    if($statement->execute()) {
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      $categories_list = '';
      $i = 0;
      foreach($row as $category) {
        $i++;
        $categories_list .= "
        <tr>
          <td>$i</td>
          <td class='category-code'>$category->code</td>
          <td class='category-name'>$category->full_name</td>
          <td>
            <button type='button' class='btn btn-primary reading' data-id='$category->id' id='editBtn'><i class='fas fa-edit'></i></button>
            <button type='button' class='btn btn-danger reading' data-id='$category->id' id='deleteBtn'><i class='fas fa-trash-alt'></i></button>
            <button type='button' class='btn btn-success editing' data-id='$category->id' id='submitBtn'><i class='fas fa-check'></i></button>
            <button type='button' class='btn btn-primary editing' data-id='$category->id' id='cancelBtn'><i class='fas fa-times'></i></button>
          </td>
        </tr>
        ";
      }
      echo $categories_list;
    } else {
      echo "Something went wrong!";
    }
  }

  // fetch batch list
  if(isset($_GET['action']) && $_GET['action'] == 'fetchCategories') {
    returnCategories();
  }


  // Add class on click of Submit button in tfoot
  if(isset($_POST['action']) && $_POST['action'] == 'addClass') {
    $batch_code = $_POST['batchCode'];
    $batch_template = $_POST['batchTemplate'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    $date = $_POST['date'];
    $class_code = $_POST['classCode'];
    $instructor_code = $_POST['instructorCode'];
    $start_time = $_POST['startTime'];
    $end_time = $_POST['endTime'];
    $room_code = $_POST['roomCode'];

    $query = "INSERT INTO `timetable`
    ( `batch_code`, `class_date`, `class_code`, `instructor_code`, `start_time`, `end_time`, `room_code`)
    VALUES
    (:BATCH_CODE,:SELECTED_DATE,:CLASS_CODE,:INSTRUCTOR_CODE,:STARTTIME,:ENDTIME,:ROOM)";
    $statement = $connection->prepare($query);
    $params = array ('BATCH_CODE'=>$batch_code,'SELECTED_DATE'=>$date,'CLASS_CODE'=>$class_code,'INSTRUCTOR_CODE'=>$instructor_code,'STARTTIME'=>$start_time,'ENDTIME'=>$end_time,'ROOM'=>$room_code);

    // Update timetable if query is successful
    if($statement->execute($params)) {
      update_timetable_list($batch_code, $batch_template, $orderBy, $ascOrDesc);
    } else {
      echo "<script>alert('Sorry, Class not added!')</script>";
    }
  }

  // Delete item on click of delete button
  if(isset($_POST['action']) && $_POST['action'] == 'delete') {
    $deleteId = $_POST['deleteId'];

    $query = "DELETE FROM categories WHERE id=$deleteId LIMIT 1";
    $statement = $connection->prepare($query);
    if($statement->execute()) {
      returnCategories();
    } else {
      echo "Something went wrong!";
    }
  }

  // Submit class on click of submit button after editing
  if(isset($_POST['action']) && $_POST['action'] == 'submit') {
    $newCode = $_POST['newCode'];
    $newName = $_POST['newName'];
    $submitId = $_POST['submitId'];

    $query = "UPDATE categories SET code = '$newCode', full_name = '$newName' WHERE id = $submitId LIMIT 1";
    $statement = $connection->prepare($query);

    if($statement->execute()) {
      returnCategories();
    } else {
      echo "Something went wrong!";
    }
  }
?>
