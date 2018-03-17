<?php
  include 'includes/connect.php';
  // include 'includes/template_reader.php';
?>

<?php
  function update_batch_list($order_by, $ascOrDesc) {
    global $connection;
    $query = "SELECT * FROM batch ORDER BY  $order_by $ascOrDesc";
    $statement = $connection->prepare($query);

    if($statement->execute()) {
      $batch_list = '';
      $i = 1;

      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $batch) {

        // highlight rows for past | present | future classes
        $batch_end_date = date('Y-m-d', strtotime($batch->batch_end_date));
        $now_date = date("Y-m-d", time());
        $batch_date_seconds = strtotime($batch_end_date);
        $now_date_seconds = strtotime($now_date);
        $diff_in_seconds = $batch_date_seconds - $now_date_seconds;
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

        $batch_list .= '
        <tr class="'.$row_highlight_class.'" id="editbatch_'.$batch->id.'">
          <td scope="row">'.
            $i
          .'</td>
          <td class="edit-batch" data-batch='.$batch->batch_code.'>'.
          $batch->batch_code
          .'</td>
          <td class="edit-batch" data-batch='.$batch->batch_name.'>'.
          $batch->batch_name
          .'</td>
          <td class="edit-start-date" data-startdate='.$batch->batch_start_date.'>'.
            date('j M y | D', strtotime($batch->batch_start_date))
          .'</td>
          <td class="edit-end-date" data-enddate='.$batch->batch_end_date.'>'.
            date('j M y | D', strtotime($batch->batch_end_date))
          .'</td>
          <td class="edit-end-date" data-enddate='.$batch->batch_students.'>'.
            $batch->batch_students
          .'</td>
          <td class="edit-delete-buttons">'.
            (!($diff_in_seconds = 0) ? // always true (simple hack to show below buttons for each iteration)
            // (!($diff_in_seconds < 0) ?
            ' <span class="text-danger reading" id="editClass" data-class-id="'.$batch->id.'">Edit</span>
              <span class="text-danger reading" id="deleteClass" data-class-id="'.$batch->id.'">Del</span>
              <span class="text-danger editing" id="cancelClass" data-class-id="'.$batch->id.'">Can</span>
              <span class="text-danger editing" id="submitClass" data-class-id="'.$batch->id.'">Sub</span>
            ' : '')
          .'</td>
        </tr>
        ';
        $i++;
      }
      echo $batch_list;
    }
  }

  // Update time table on change of batch (list-layout)
  if(isset($_GET['action']) && $_GET['action'] == 'updateBatchList') {
    update_batch_list($_GET['orderBy'], $_GET['ascOrDesc']);
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
