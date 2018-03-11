<?php
  include 'includes/connect.php';
  include 'includes/template_reader.php';
?>

<?php
  function update_timetable($code, $temp) {
    global $connection;
    $query = "SELECT * FROM timetable WHERE batch_code=:batchCode ORDER BY date";
    $statement = $connection->prepare($query);
    $statement->bindParam(":batchCode", $code);

    if($statement->execute()) {
      $date_now = new DateTime("now");
      $batch_template = $temp;
      global $batch_obj;
      $batch = $batch_obj[$batch_template];
      $timetable = '';
      $i = 1;
      $row_highlight_class = 'table-success';

      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $class) {

        // var_dump(date('Y-m-d', strtotime($class->date)));

        $class_date = date('Y-m-d', strtotime($class->date));
        $now_date = date("Y-m-d", time());
        $class_date_seconds = strtotime($class_date);
        $now_date_seconds = strtotime($now_date);
        $diff_in_seconds = $class_date_seconds - $now_date_seconds;
        // past
        if($diff_in_seconds < 0) {
          $row_highlight_class = 'table-active';
          // future
        } else if($diff_in_seconds > 0) {
          $row_highlight_class = 'table-primary';
          // present
        } else {
          $row_highlight_class = 'table-success';
        }

        $timetable .= '
        <tr class="'.$row_highlight_class.'">
          <td scope="row">'.
            $i
          .'</td>
          <td>'.
            date('j M y | D', strtotime($class->date))
          .'</td>
          <td>'.
            $batch['classes'][$class->class_code]
          .'</td>
          <td>'.
            $batch['instructors'][$class->instructor_code]
          .'</td>
          <td>'.
            date('h:i A', strtotime($class->start_time))
            .' - '.
            date('h:i A', strtotime($class->end_time))
          .'</td>
          <td>'.
            $batch['rooms'][$class->room_code]
          .'</td>
          <td class="edit-delete-buttons">'.
            (!($diff_in_seconds = 0) ?
            // (!($diff_in_seconds < 0) ? 
            ' <span class="text-danger" id="editClass" data-class-id="'.$class->id.'">Edit</span>
            | <span class="text-danger" id="deleteClass" data-class-id="'.$class->id.'">Del</span>
            ' : '')
          .'</td>
        </tr>
        ';
        $i++;
      }
      echo $timetable;
    }
  }

  // Update time table on change of batch
  if(isset($_GET['action']) && $_GET['action'] == 'updateTimeTable') {
    update_timetable($_GET['batchCode'], $_GET['batchTemplate']);
  }

  // Add class on Submit btn click
  if(isset($_POST['action']) && $_POST['action'] == 'addClass') {
    $batch_code = $_POST['batchCode'];
    $batch_template = $_POST['batchTemplate'];

    $date = $_POST['date'];
    $class_code = $_POST['classCode'];
    $instructor_code = $_POST['instructorCode'];
    $start_time = $_POST['startTime'];
    $end_time = $_POST['endTime'];
    $room_code = $_POST['roomCode'];

    $query = "INSERT INTO `timetable`
    ( `batch_code`, `date`, `class_code`, `instructor_code`, `start_time`, `end_time`, `room_code`)
    VALUES
    (:BATCH_CODE,:SELECTED_DATE,:CLASS_CODE,:INSTRUCTOR_CODE,:STARTTIME,:ENDTIME,:ROOM)";
    $statement = $connection->prepare($query);
    $params = array ('BATCH_CODE'=>$batch_code,'SELECTED_DATE'=>$date,'CLASS_CODE'=>$class_code,'INSTRUCTOR_CODE'=>$instructor_code,'STARTTIME'=>$start_time,'ENDTIME'=>$end_time,'ROOM'=>$room_code);

    // Update timetable if query is successful
    if($statement->execute($params)) {
      update_timetable($batch_code, $batch_template);
    }
  }

  // Delete class on click of delete button
  if(isset($_POST['action']) && $_POST['action'] == 'deleteClass') {
    $batch_code = $_POST['batchCode'];
    $batch_template = $_POST['batchTemplate'];

    $delete_id = $_POST['deleteId'];

    $query = "DELETE FROM timetable WHERE id=:deleteId LIMIT 1";
    $statement = $connection->prepare($query);
    $statement->bindParam(":deleteId", $delete_id);
    if($statement->execute()) {
      update_timetable($batch_code, $batch_template);
    } else {
      echo "Something went wrong!";
    }

    // update_timetable($batch_code, $batch_template);
  }
 ?>
