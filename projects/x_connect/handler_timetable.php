<?php
  include 'includes/connect.php';
  include 'includes/template_reader.php';
?>

<?php
  function update_timetable_list($code, $temp) {
    global $connection;
    $query = "SELECT * FROM timetable WHERE batch_code=:batchCode ORDER BY date";
    $statement = $connection->prepare($query);
    $statement->bindParam(":batchCode", $code);

    if($statement->execute()) {
      $date_now = new DateTime("now");
      $batch_template = $temp;
      global $batch_obj;
      $batch = $batch_obj[$batch_template];
      $timetable_list = '';
      $i = 1;

      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $class) {

        // highlight rows for past | present | future classes
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

        $timetable_list .= '
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
            (!($diff_in_seconds = 0) ? // always true (simple hack to show below buttons for each iteration)
            // (!($diff_in_seconds < 0) ?
            ' <span class="text-danger" id="editClass" data-class-id="'.$class->id.'">Edit</span>
            | <span class="text-danger" id="deleteClass" data-class-id="'.$class->id.'">Del</span>
            ' : '')
          .'</td>
        </tr>
        ';
        $i++;
      }
      echo $timetable_list;
    }
  }
  function update_timetable_grid($from_date, $to_date) {
    // echo $from_date."<br>";
    // echo $to_date;

    global $connection;
    $query = "SELECT * FROM timetable WHERE date>=:fromDate AND date<=:toDate ORDER BY date";
    // $query = "SELECT * FROM timetable WHERE (date BETWEEN $from_date AND $to_date)";
    $statement = $connection->prepare($query);
    $statement->bindParam(":fromDate", $from_date);
    $statement->bindParam(":toDate", $to_date);

    if($statement->execute()) {
      $timetable_grid = '';
      $i = 1;


      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $class) {
        $timetable_grid .= $class->class_code.'<br>';
      }
      echo $timetable_grid;
    }
  }

  // Update time table on change of batch (list-layout)
  if(isset($_GET['action']) && $_GET['action'] == 'updateTimeTableList') {
    update_timetable_list($_GET['batchCode'], $_GET['batchTemplate']);
  }

  // Update time table on change of date (grid-layout)
  if(isset($_GET['action']) && $_GET['action'] == 'updateTimeTableGrid') {
    update_timetable_grid($_GET['filterStartDate'], $_GET['filterEndDate']);
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
