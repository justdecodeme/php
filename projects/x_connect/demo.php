<?php include 'includes/connect.php'; ?>

<?php
  $sql = "SELECT * FROM timetable WHERE batch_code=:batchId";
  $query = $connection->prepare($sql);
  $query->bindParam(":batchId", $_GET['batchId']);

  if($query->execute()) {
    $result = $query->fetchAll(PDO::FETCH_OBJ);
    $timetable = '';
    $i = 1;
    foreach($result as $class) {
      // $timetable .= '<p><b>'.$class->batch_code. ' </b><span>'.$class->class . ' </span> | <span>'.date('m-d-Y', strtotime($class->date)).'</span></p>';
      $timetable .= '
      <tr>
        <td scope="row">'.$i.'</td>
        <td>'.date('m-d-Y', strtotime($class->date)).'</td>
        <td>'.$class->class.'</td>
        <td>'.$class->instructor_code.'</td>
        <td>'.$class->start_time.' - '.$class->end_time.'</td>
        <td>'.$class->room.'</td>
        <td><a class="text-danger" href="#">Edit</a> | <a class="text-danger" href="#">Delete</a></td>
      </tr>
      ';
      $i++;
    }
    echo $timetable;
  }
 ?>
