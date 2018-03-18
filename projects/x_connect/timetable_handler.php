<?php
  include 'includes/connect.php';
  include 'includes/template_reader.php';
?>

<?php
  function update_timetable_list($code, $temp, $order_by, $ascOrDesc) {
    global $connection;
    $query = "SELECT * FROM timetable WHERE batch_code=:batchCode ORDER BY " . $order_by . " " . $ascOrDesc;
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
          <td class="edit-date" data-date='.$class->date.'>'.
            date('j M y | D', strtotime($class->date))
          .'</td>
          <td class="edit-class" data-class='.$class->class_code.'>'.
            $batch['classes'][$class->class_code]
          .'</td>
          <td class="edit-instructor" data-instructor='.$class->instructor_code.'>'.
            $batch['instructors'][$class->instructor_code]
          .'</td>
          <td class="edit-time" data-starttime='.$class->start_time.' data-endtime='.$class->end_time.'>'.
            date('h:i A', strtotime($class->start_time))
            .' - '.
            date('h:i A', strtotime($class->end_time))
          .'</td>
          <td class="edit-room" data-room='.$class->room_code.'>'.
            $batch['rooms'][$class->room_code]
          .'</td>
          <td class="edit-delete-buttons">'.
            (!($diff_in_seconds = 0) ? // always true (simple hack to show below buttons for each iteration)
            // (!($diff_in_seconds < 0) ?
            ' <span class="text-danger reading" id="editClass" data-class-id="'.$class->id.'">Edit</span>
              <span class="text-danger reading" id="deleteClass" data-class-id="'.$class->id.'">Del</span>
              <span class="text-danger editing" id="cancelClass" data-class-id="'.$class->id.'">Can</span>
              <span class="text-danger editing" id="submitClass" data-class-id="'.$class->id.'">Sub</span>
            ' : '')
          .'</td>
        </tr>
        ';
        $i++;
      }
      echo $timetable_list;
    }
  }
  function update_timetable_grid_A($from_date, $to_date) {
    global $connection;

    $rowNum = 0;
    $colNum = 0;
    $timetable_grid = '';
    $now = new DateTime();

    // to find the number of days to generate timetable
    $d_start = new DateTime($from_date);
    $d_end   = new DateTime($to_date);
    $d_end   = $d_end->modify( '+1 day' );
    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($d_start, $interval ,$d_end);
    // $diff = $d_start->diff($d_end);
    // $total_days = $diff->format('%d') + 1;

    foreach($daterange as $date) {
      $date   = $date->format("Y-m-d");

      $query = "SELECT * FROM timetable WHERE date=:clssDATE AND `room_code`='a'";
      $statement = $connection->prepare($query);
      $statement->bindParam(":clssDATE", $date);

      if((8 * $rowNum) + 1 == $colNum + 1) {
        $colNum++;
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

      if($statement->execute() AND $statement->rowCount() !== 0) {
        $classes = $statement->fetchAll();
        $colNum++;

        $i = 0;
        $totalClass = $statement->rowCount();

        foreach($classes as $class) {
          if($i == 0) {
            if(date('Y-m-d', strtotime($classes[$i]['date'])) == $now->format('Y-m-d')) {
              $timetable_grid .= "<td class='table-success'><p>".date('j M', strtotime($classes[$i]['date'])) . "</p>";
            } else {
              $timetable_grid .= "<td><p>".date('j M', strtotime($classes[$i]['date'])) . "</p>";
            }
          }
          while($totalClass) {
            $timetable_grid .= "<p>".$classes[$i]['class_code']." (". $classes[$i]['instructor_code'] .")</p>";
            $totalClass--;
            $i++;
          }
          while($i < 4) {
            $timetable_grid .= "<p></p>";
            $i++;
          }
          $timetable_grid .= "</td>";
        }
      } else {
        $colNum++;
        if($date == $now->format('Y-m-d')) {
          $timetable_grid .= "<td class='table-success'>";
        } else {
          $timetable_grid .= "<td>";
        }
        $timetable_grid .= "
        <p>".date('j M', strtotime($date))."</p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        </td>
        ";
      }

      if(8 * ($rowNum + 1) == $colNum) {
        $timetable_grid .= '</tr>';
        $rowNum++;
      }
    }
    echo $timetable_grid;

  }
  function update_timetable_grid_B($from_date, $to_date) {
    global $connection;

    $rowNum = 0;
    $colNum = 0;
    $timetable_grid = '';
    $now = new DateTime();

    // to find the number of days to generate timetable
    $d_start = new DateTime($from_date);
    $d_end   = new DateTime($to_date);
    $d_end   = $d_end->modify( '+1 day' );
    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($d_start, $interval ,$d_end);
    // $diff = $d_start->diff($d_end);
    // $total_days = $diff->format('%d') + 1;

    foreach($daterange as $date) {
      $date   = $date->format("Y-m-d");

      $query = "SELECT * FROM timetable WHERE date=:clssDATE AND `room_code`='b'";
      $statement = $connection->prepare($query);
      $statement->bindParam(":clssDATE", $date);

      if((8 * $rowNum) + 1 == $colNum + 1) {
        $colNum++;
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

      if($statement->execute() AND $statement->rowCount() !== 0) {
        $classes = $statement->fetchAll();
        $colNum++;

        $i = 0;
        $totalClass = $statement->rowCount();

        foreach($classes as $class) {
          if($i == 0) {
            if(date('Y-m-d', strtotime($classes[$i]['date'])) == $now->format('Y-m-d')) {
              $timetable_grid .= "<td class='table-success'><p>".date('j M', strtotime($classes[$i]['date'])) . "</p>";
            } else {
              $timetable_grid .= "<td><p>".date('j M', strtotime($classes[$i]['date'])) . "</p>";
            }
          }
          while($totalClass) {
            $timetable_grid .= "<p>".$classes[$i]['class_code']." (". $classes[$i]['instructor_code'] .")</p>";
            $totalClass--;
            $i++;
          }
          while($i < 4) {
            $timetable_grid .= "<p></p>";
            $i++;
          }
          $timetable_grid .= "</td>";
        }
      } else {
        $colNum++;
        if($date == $now->format('Y-m-d')) {
          $timetable_grid .= "<td class='table-success'>";
        } else {
          $timetable_grid .= "<td>";
        }
        $timetable_grid .= "
        <p>".date('j M', strtotime($date))."</p>
        <p></p>
        <p></p>
        <p></p>
        <p></p>
        </td>
        ";
      }

      if(8 * ($rowNum + 1) == $colNum) {
        $timetable_grid .= '</tr>';
        $rowNum++;
      }
    }
    echo $timetable_grid;

  }

  // Update time table on change of batch (list-layout)
  if(isset($_GET['action']) && $_GET['action'] == 'updateTimeTableList') {
    update_timetable_list($_GET['batchCode'], $_GET['batchTemplate'], $_GET['orderBy'], $_GET['ascOrDesc']);
  }

  // Update time table on change of date (grid-layout)
  if(isset($_GET['action']) && $_GET['action'] == 'updateTimeTableGrid_A') {
    update_timetable_grid_A($_GET['filterStartDate'], $_GET['filterEndDate']);
  }
  // Update time table on change of date (grid-layout)
  if(isset($_GET['action']) && $_GET['action'] == 'updateTimeTableGrid_B') {
    update_timetable_grid_B($_GET['filterStartDate'], $_GET['filterEndDate']);
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
    ( `batch_code`, `date`, `class_code`, `instructor_code`, `start_time`, `end_time`, `room_code`)
    VALUES
    (:BATCH_CODE,:SELECTED_DATE,:CLASS_CODE,:INSTRUCTOR_CODE,:STARTTIME,:ENDTIME,:ROOM)";
    $statement = $connection->prepare($query);
    $params = array ('BATCH_CODE'=>$batch_code,'SELECTED_DATE'=>$date,'CLASS_CODE'=>$class_code,'INSTRUCTOR_CODE'=>$instructor_code,'STARTTIME'=>$start_time,'ENDTIME'=>$end_time,'ROOM'=>$room_code);

    // Update timetable if query is successful
    if($statement->execute($params)) {
      update_timetable_list($batch_code, $batch_template, $orderBy, $ascOrDesc);
    }
  }

  // Submit class on click of submit button after editing
  if(isset($_POST['action']) && $_POST['action'] == 'submitClass') {
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

    $submit_id = $_POST['submitId'];

    $query = "UPDATE `timetable`
      SET
        `date` = :SELECTED_DATE,
        `class_code` = :CLASS_CODE,
        `instructor_code` = :INSTRUCTOR_CODE,
        `start_time` = :STARTTIME,
        `end_time` = :ENDTIME,
        `room_code` = :ROOM
      WHERE
        `id` = $submit_id
      LIMIT 1";
    $statement = $connection->prepare($query);
    $params = array ('SELECTED_DATE'=>$date,'CLASS_CODE'=>$class_code,'INSTRUCTOR_CODE'=>$instructor_code,'STARTTIME'=>$start_time,'ENDTIME'=>$end_time,'ROOM'=>$room_code);

    // Update timetable if query is successful
    if($statement->execute($params)) {
      update_timetable_list($batch_code, $batch_template, $orderBy, $ascOrDesc);
    } else {
      echo "Something went wrong!";
    }
  }

  // Delete class on click of delete button
  if(isset($_POST['action']) && $_POST['action'] == 'deleteClass') {
    $batch_code = $_POST['batchCode'];
    $batch_template = $_POST['batchTemplate'];
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    $delete_id = $_POST['deleteId'];

    $query = "DELETE FROM timetable WHERE id=:deleteId LIMIT 1";
    $statement = $connection->prepare($query);
    $statement->bindParam(":deleteId", $delete_id);
    if($statement->execute()) {
      update_timetable_list($batch_code, $batch_template, $orderBy, $ascOrDesc);
    } else {
      echo "Something went wrong!";
    }

    // update_timetable_list($batch_code, $batch_template);
  }
 ?>