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
        <tr class="'.$row_highlight_class.'" id="editClass_'.$class->id.'">
          <td scope="row">'.
            $i
          .'</td>
          <td class="edit-date">'.
            date('j M y | D', strtotime($class->date))
          .'</td>
          <td class="edit-class">'.
            $batch['classes'][$class->class_code]
          .'</td>
          <td class="edit-instructor">'.
            $batch['instructors'][$class->instructor_code]
          .'</td>
          <td class="edit-time">'.
            date('h:i A', strtotime($class->start_time))
            .' - '.
            date('h:i A', strtotime($class->end_time))
          .'</td>
          <td class="edit-room">'.
            $batch['rooms'][$class->room_code]
          .'</td>
          <td class="edit-delete-buttons">'.
            (!($diff_in_seconds = 0) ? // always true (simple hack to show below buttons for each iteration)
            // (!($diff_in_seconds < 0) ?
            ' <span class="text-danger reading" id="editClass" data-class-id="'.$class->id.'">Edit</span>
              <span class="text-danger reading" id="deleteClass" data-class-id="'.$class->id.'">Del</span>
              <span class="text-danger editing" id="cancelEditingClass" data-class-id="'.$class->id.'">Cancel</span>
              <span class="text-danger editing" id="submitEditingClass" data-class-id="'.$class->id.'">Submit</span>
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
    global $connection;
    $query = "SELECT * FROM timetable WHERE date>=:fromDate AND date<=:toDate ORDER BY date";
    $statement = $connection->prepare($query);
    $statement->bindParam(":fromDate", $from_date);
    $statement->bindParam(":toDate", $to_date);

    // to find the number of days to generate timetable
    $d_start    = new DateTime($from_date);
    $d_end      = new DateTime($to_date);
    $diff = $d_start->diff($d_end);
    $total_days = $diff->format('%d') + 1;

    $i = 1;
    $timetable_grid = '';

    if($statement->execute()) {

      // for($i = 1; i <= $total_days; $i = $i + 7) {
      //   $timetable_grid = '
      //     <tr>
      //       <td>
      //         <p>Time</p>
      //         <p>09:00 AM</p>
      //         <p>11:30 AM</p>
      //         <p>02:00 AM</p>
      //         <p>04:30 AM</p>
      //       </td>
      //   ';
      //   for($j = 1; i <= 7; $j++) {
      //
      //   }
      // }

      $row = $statement->fetchAll(PDO::FETCH_OBJ);

      foreach($row as $class) {
        // echo $i . '* | ' . $class->date . '<br>';
        if($i == 1 || $i == 9 || $i == 17 || $i == 28) {
          $timetable_grid .= "
            <tr>
              <td>
                <p>Time</p>
                <p>09:00 AM</p>
                <p>11:30 AM</p>
                <p>02:00 AM</p>
                <p>04:30 AM</p>
              </td>
          ";
        }
        $timetable_grid .= "
          <td>
            <p>".date('j M', strtotime($class->date))."</p>
            <p>$class->class_code</p>
            <p>$class->instructor_code</p>
            <p>-</p>
            <p>-</p>
          </td>
        ";
        if($i == 8 || $i == 16 || $i == 21 || $i == 29) {
          $timetable_grid .= '</tr>';
        }
        $i++;
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
      update_timetable_list($batch_code, $batch_template);
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
      update_timetable_list($batch_code, $batch_template);
    } else {
      echo "Something went wrong!";
    }

    // update_timetable_list($batch_code, $batch_template);
  }
 ?>
