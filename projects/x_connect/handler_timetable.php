<?php include 'includes/connect.php'; ?>

<?php
  // $url = '_assets/js/demo.json'; // path to your JSON file
  // $data = file_get_contents($url); // put the contents of the file into a variable
  // $batch = json_decode($data, true); // decode the JSON feed
  // echo ($batch['unity']['classes']['u1']);
  // var_dump($batch);
 ?>

<?php
  // Update time table on change of batch
  if(isset($_GET['action']) && $_GET['action'] == 'updateTimeTable') {
    $query = "SELECT * FROM timetable WHERE batch_code=:batchCode";
    $statement = $connection->prepare($query);
    $statement->bindParam(":batchCode", $_GET['batchCode']);

    if($statement->execute()) {
      echo $_GET['batchTemplate'];
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      $timetable = '';
      $i = 1;
      foreach($row as $class) {
        $timetable .= '
        <tr>
        <td scope="row">'.$i.'</td>
        <td>'.date('m-d-Y', strtotime($class->date)).'</td>
        <td>'.$class->class_code.'</td>
        <td>'.$class->instructor_code.'</td>
        <td>'.date('h:i A', strtotime($class->start_time)).' - '.date('h:i A', strtotime($class->end_time)).'</td>
        <td>'.$class->room_code.'</td>
        <td><a class="text-danger" href="#"><i class="fa fa-edit"></i></a> | <a class="text-danger" href="#"><i class="fa fa-trash-alt"></i></a></td>
        </tr>
        ';
        $i++;
      }
      echo $timetable;
    }

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

    $query = "INSERT INTO `timetable` ( `batch_code`, `date`, `class_code`, `instructor_code`, `start_time`, `end_time`, `room_code`)
    VALUES (:BATCH_CODE,:SELECTED_DATE,:CLASS_CODE,:INSTRUCTOR_CODE,:STARTTIME,:ENDTIME,:ROOM)";
    $statement = $connection->prepare($query);
    $params = array ('BATCH_CODE'=>$batch_code,'SELECTED_DATE'=>$date,'CLASS_CODE'=>$class_code,'INSTRUCTOR_CODE'=>$instructor_code,'STARTTIME'=>$start_time,'ENDTIME'=>$end_time,'ROOM'=>$room_code);

    // Update timetable if query is successful
    if($statement->execute($params)) {
      $query = "SELECT * FROM timetable WHERE batch_code=:batchCode";
      $statement = $connection->prepare($query);
      $statement->bindParam(":batchCode", $batch_code);

      if($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        $timetable = '';
        $i = 1;
        foreach($row as $class) {
          $timetable .= '
          <tr>
          <td scope="row">'.$i.'</td>
          <td>'.date('m-d-Y', strtotime($class->date)).'</td>
          <td>'.$class->class_code.'</td>
          <td>'.$class->instructor_code.'</td>
          <td>'.date('h:i A', strtotime($class->start_time)).' - '.date('h:i A', strtotime($class->end_time)).'</td>
          <td>'.$class->room_code.'</td>
          <td><a class="text-danger" href="#"><i class="fa fa-edit"></i></a> | <a class="text-danger" href="#"><i class="fa fa-trash-alt"></i></a></td>
          </tr>
          ';
          $i++;
        }
        echo $timetable;
      }
    }
  }
 ?>
