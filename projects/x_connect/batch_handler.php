<?php
  include 'includes/connect.php';
  // include 'includes/template_reader.php';
?>

<?php
  function fetch_batch_list() {
    global $connection;
    $query = "SELECT * FROM batch ORDER BY batch_code";
    $statement = $connection->prepare($query);
    if($statement->execute()) {
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      $batch_list = '';
      $i = 0;
      foreach($row as $batch) {
        // mark first option selected by default
        if($i == 0) {
          $batch_list .= '<option value="'.$batch->batch_code.'" data-template="'.$batch->batch_template.'" selected>'.$batch->batch_code.' ('.$batch->batch_name.')</option>';
          $i++;
        } else {
          $batch_list .= '<option value="'.$batch->batch_code.'" data-template="'.$batch->batch_template.'">'.$batch->batch_code.' ('.$batch->batch_name.')</option>';
        }
      }
      echo $batch_list;
    } else {
      echo "Something went wrong!";
    }
  }

  function update_batch_list($order_by, $ascOrDesc) {
    global $connection;
    $query = "SELECT * FROM batch ORDER BY  $order_by $ascOrDesc";
    $statement = $connection->prepare($query);

    if($statement->execute()) {
      $batch_list = '';
      $i = 1;
      $now_date = date("Y-m-d", time());
      $now_date_seconds = strtotime($now_date);

      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $batch) {

        // fetch batch start date, start date = first batch class
        $query1a = "SELECT * FROM timetable WHERE batch_code='$batch->batch_code' ORDER BY class_date ASC LIMIT 1";
        // update batch start date
        foreach($connection->query($query1a) as $row){
          $start_date = $row['class_date'];
          $query1b = "UPDATE `batch` SET `batch_start_date` ='$start_date' WHERE batch_code='$batch->batch_code'";
          $result = $connection->exec($query1b);
        }
        // fetch batch end date, end date = last batch class
        $query2a = "SELECT * FROM timetable WHERE batch_code='$batch->batch_code' ORDER BY class_date DESC LIMIT 1";
        // update batch end date
        foreach($connection->query($query2a) as $row){
          $end_date = $row['class_date'];
          $query2b = "UPDATE `batch` SET `batch_end_date` ='$end_date' WHERE batch_code='$batch->batch_code'";
          $result = $connection->exec($query2b);
        }

        // calculate total number of students in the each batch
        $query = "SELECT COUNT(*) FROM users WHERE batch_code='$batch->batch_code'";
        $statement = $connection->prepare($query);
        if($statement->execute()) {
          $students = $statement->fetchColumn();
        } else {
          $students = '-';
        }

        // Batch Start: highlight rows for past | present | future classes
        $batch_start_date = date('Y-m-d', strtotime($batch->batch_start_date));
        $batch_date_seconds = strtotime($batch_start_date);
        $diff_in_seconds_start = $batch_date_seconds - $now_date_seconds;
        // past
        if($diff_in_seconds_start < 0) {
          $row_highlight_class_start = 'table-danger';
          // future
        } else if($diff_in_seconds_start > 0) {
          $row_highlight_class_start = 'table-primary';
          // present
        } else {
          $row_highlight_class_start = 'table-success';
        }

        // Batch end: highlight rows for past | present | future classes
        $batch_end_date = date('Y-m-d', strtotime($batch->batch_end_date));
        $batch_date_seconds = strtotime($batch_end_date);
        $diff_in_seconds_end = $batch_date_seconds - $now_date_seconds;
        // past
        if($diff_in_seconds_end < 0) {
          $row_highlight_class_end = 'table-danger';
          // future
        } else if($diff_in_seconds_end > 0) {
          $row_highlight_class_end = 'table-primary';
          // present
        } else {
          $row_highlight_class_end = 'table-success';
        }

        $batch_list .= '
        <tr id="editBatch_'.$batch->id.'">
          <td scope="row">'.
            $i
          .'</td>
          <td class="edit-batch-code" data-batch-code='.$batch->batch_code.'>'.
          $batch->batch_code
          .'</td>
          <td class="edit-batch-name" data-batch-name='.$batch->batch_name.'>'.
          $batch->batch_name
          .'</td>
          <td class="edit-batch-start-date ' . $row_highlight_class_start . '" data-batch-start-date='.$batch->batch_start_date.'>'.
            date('j M y | D', strtotime($batch->batch_start_date))
          .'</td>
          <td class="edit-batch-end-date ' . $row_highlight_class_end . '" data-batch-end-date='.$batch->batch_end_date.'>'.
            date('j M y | D', strtotime($batch->batch_end_date))
          .'</td>
          <td class="edit-batch-students" data-batch-students='.$students.'>'.
            $students
          .'</td>
          <td class="edit-delete-buttons">'.
            (!($diff_in_seconds_end = 0) ? // always true (simple hack to show below buttons for each iteration)
            // (!($diff_in_seconds_end < 0) ?
            ' <span class="text-danger reading" id="editBatch" data-batch-id="'.$batch->id.'">Edit</span>
              <span class="text-danger reading" id="deleteBatch" data-batch-id="'.$batch->id.'">Del</span>
              <span class="text-danger editing" id="cancelBatch" data-batch-id="'.$batch->id.'">Can</span>
              <span class="text-danger editing" id="submitBatch" data-batch-id="'.$batch->id.'">Sub</span>
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
  if(isset($_POST['action']) && $_POST['action'] == 'addBatch') {
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    $batch_code = $_POST['batchCode'];
    // $batch_template = $_POST['batchTemplate'];
    $batch_name = $_POST['batchName'];
    $batch_start_date = $_POST['batchStartDate'];
    $batch_end_date = $_POST['batchEndDate'];

    $query = "INSERT INTO `batch`
    ( `batch_code`, `batch_name`, `batch_start_date`, `batch_end_date`)
    VALUES
    (:BATCH_CODE,:BATCH_NAME,:BATCH_START_DATE,:BATCH_END_DATE)";
    $statement = $connection->prepare($query);
    $params = array ('BATCH_CODE'=>$batch_code,'BATCH_NAME'=>$batch_name,'BATCH_START_DATE'=>$batch_start_date,'BATCH_END_DATE'=>$batch_end_date);

    // Update timetable if query is successful
    if($statement->execute($params)) {
      update_batch_list($orderBy, $ascOrDesc);
    }
  }

  // Submit batch on click of submit button after editing
  if(isset($_POST['action']) && $_POST['action'] == 'submitBatch') {
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    $batch_code = $_POST['batchCode'];
    // $batch_template = $_POST['batchTemplate'];
    $batch_name = $_POST['batchName'];
    // $batch_start_date = $_POST['batchStartDate'];
    // $batch_end_date = $_POST['batchEndDate'];
    // $batch_students = $_POST['batchStuents'];

    $submit_id = $_POST['submitId'];

    // `batch_start_date` = :BATCH_START_DATE,
    // `batch_end_date` = :BATCH_END_DATE,
    // `batch_students` = :BATCH_STUDENTS
    $query = "UPDATE `batch`
      SET
        `batch_code` = :BATCH_CODE,
        `batch_name` = :BATCH_NAME
      WHERE
        `id` = $submit_id
      LIMIT 1";
    $statement = $connection->prepare($query);
    $params = array (
      'BATCH_CODE'=>$batch_code,
      'BATCH_NAME'=>$batch_name
    );
    // 'BATCH_START_DATE'=>$batch_start_date,
    // 'BATCH_END_DATE'=>$batch_end_date,
    // 'BATCH_STUDENTS'=>$batch_students

    // Update timetable if query is successful
    if($statement->execute($params)) {
      update_batch_list($orderBy, $ascOrDesc);
    } else {
      echo "Something went wrong!";
    }
  }

  // Delete batch on click of delete button
  if(isset($_POST['action']) && $_POST['action'] == 'deleteBatch') {
    $orderBy = $_POST['orderBy'];
    $ascOrDesc = $_POST['ascOrDesc'];

    $delete_id = $_POST['deleteId'];

    $query = "DELETE FROM batch WHERE id=:deleteId LIMIT 1";
    $statement = $connection->prepare($query);
    $statement->bindParam(":deleteId", $delete_id);
    if($statement->execute()) {
      update_batch_list($orderBy, $ascOrDesc);
    } else {
      echo "Something went wrong!";
    }
  }

  // fetch batch list
  if(isset($_GET['action']) && $_GET['action'] == 'fetchBatchList') {
    fetch_batch_list();
  }
 ?>
