<?php include 'includes/connect.php'; ?>

<?php
  // Update time table on change of batch
  if(isset($_GET['action']) && $_GET['action'] == 'updateTimeTable') {
    $query = "SELECT * FROM timetable WHERE batch_code=:batchId";
    $statement = $connection->prepare($query);
    $statement->bindParam(":batchId", $_GET['batchId']);

    if($statement->execute()) {
      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      $timetable = '';
      $i = 1;
      foreach($row as $class) {
        $timetable .= '
        <tr>
        <td scope="row">'.$i.'</td>
        <td>'.date('m-d-Y', strtotime($class->date)).'</td>
        <td>'.$class->class.'</td>
        <td>'.$class->instructor_code.'</td>
        <td>'.date('h:i A', strtotime($class->start_time)).' - '.date('h:i A', strtotime($class->end_time)).'</td>
        <td>'.$class->room.'</td>
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
    $batchCode = $_POST['batchCode'];
    $date = $_POST['date'];
    $className = $_POST['className'];
    $instructorCode = $_POST['instructorCode'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $room = $_POST['room'];

    $query = "INSERT INTO `timetable` ( `batch_code`, `date`, `class`, `instructor_code`, `start_time`, `end_time`, `room`)
    VALUES (:BATCH_CODE,:SELECTED_DATE,:CLASSNAME,:INSTRUCTOR_CODE,:STARTTIME,:ENDTIME,:ROOM)";
    $statement = $connection->prepare($query);
    $params = array ('BATCH_CODE'=>$batchCode,'SELECTED_DATE'=>$date,'CLASSNAME'=>$className,'INSTRUCTOR_CODE'=>$instructorCode,'STARTTIME'=>$startTime,'ENDTIME'=>$endTime,'ROOM'=>$room);

    // Update timetable if query is successful
    if($statement->execute($params)) {
      $query = "SELECT * FROM timetable WHERE batch_code=:batchId";
      $statement = $connection->prepare($query);
      $statement->bindParam(":batchId", $batchCode);

      if($statement->execute()) {
        $row = $statement->fetchAll(PDO::FETCH_OBJ);
        $timetable = '';
        $i = 1;
        foreach($row as $class) {
          $timetable .= '
          <tr>
          <td scope="row">'.$i.'</td>
          <td>'.date('m-d-Y', strtotime($class->date)).'</td>
          <td>'.$class->class.'</td>
          <td>'.$class->instructor_code.'</td>
          <td>'.date('h:i A', strtotime($class->start_time)).' - '.date('h:i A', strtotime($class->end_time)).'</td>
          <td>'.$class->room.'</td>
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
