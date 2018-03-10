<?php
  include 'includes/connect.php';
  include 'includes/template_reader.php';
?>

<?php
  function update_timetable($code, $temp) {
    global $connection;
    $query = "SELECT * FROM timetable WHERE batch_code=:batchCode";
    $statement = $connection->prepare($query);
    $statement->bindParam(":batchCode", $code);

    if($statement->execute()) {
      $batch_template = $temp;
      global $batch_obj;
      $batch = $batch_obj[$batch_template];
      $timetable = '';
      $i = 1;

      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $class) {
        $timetable .= '
        <tr>
        <td scope="row">'.$i.'</td>
        <td>'.date('m-d-Y', strtotime($class->date)).'</td>
        <td>'.$batch['classes'][$class->class_code].'</td>
        <td>'.$batch['instructors'][$class->instructor_code].'</td>
        <td>'.date('h:i A', strtotime($class->start_time)).' - '.date('h:i A', strtotime($class->end_time)).'</td>
        <td>'.$batch['rooms'][$class->room_code].'</td>
        <td><a class="text-danger" href="#"><i class="fa fa-edit"></i></a> | <a class="text-danger" href="#"><i class="fa fa-trash-alt"></i></a></td>
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
      update_timetable($_POST['batchCode'], $_POST['batchTemplate']);
    }
  }

  // Delete class
  if(isset($_GET['action']) && $_GET['action'] == 'deleteClass') {
    update_timetable($_GET['batchCode'], $_GET['batchTemplate']);
  }
 ?>
