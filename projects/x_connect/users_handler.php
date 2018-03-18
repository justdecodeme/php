<?php
  include 'includes/connect.php';
  include 'includes/template_reader.php';
?>

<?php
  function update_users_list($code, $role, $gender, $doj, $search, $order_by, $ascOrDesc) {
    global $connection;

    // if it is all selected in dropdown then please make it blank to match everything in LIKE
    if($code == 'all') { $code = ''; }
    if($role == 'all') { $role = ''; }
    if($gender == 'all') { $gender = ''; }

    $query = "SELECT * FROM users
      WHERE
        (username LIKE '%$search%' OR  email LIKE '%$search%') AND
        batch_code LIKE '%$code%' AND
        role LIKE '%$role%' AND
        gender LIKE '$gender%' AND
        doj <= '$doj'
      ORDER BY
        $order_by $ascOrDesc";

    $statement = $connection->prepare($query);

    if($statement->execute()) {
      $users_list = '';
      $i = 1;

      $row = $statement->fetchAll(PDO::FETCH_OBJ);
      foreach($row as $user) {
        $users_list .= '
        <tr id="editClass_'.$user->id.'">
          <td scope="row">'.
            $i
          .'</td>
          <td class="edit-username" data-username='.$user->username.'>'.
            $user->username
          .'</td>
          <td class="edit-email" data-email='.$user->email.'>'.
            $user->email
          .'</td>
          <td class="edit-role" data-role='.$user->role.'>'.
            $user->role
          .'</td>
          <td class="edit-code" data-code='.$user->student_code.'>'.
          $user->student_code
          .'</td>
          <td class="edit-code" data-code='.$user->batch_code.'>'.
          $user->batch_code
          .'</td>
          <td class="edit-code" data-code='.$user->instructor_code.'>'.
          $user->instructor_code
          .'</td>
          <td class="edit-gender" data-gender='.$user->gender.'>'.
            $user->gender
          .'</td>
          <td class="edit-doj" data-doj='.$user->doj.'>'.
            date('j M y | D', strtotime($user->doj))
          .'</td>
          <td class="edit-delete-buttons">
            <span class="text-danger reading" id="editClass" data-class-id="'.$user->id.'">Edit</span>
            <span class="text-danger reading" id="deleteClass" data-class-id="'.$user->id.'">Del</span>
            <span class="text-danger editing" id="cancelClass" data-class-id="'.$user->id.'">Can</span>
            <span class="text-danger editing" id="submitClass" data-class-id="'.$user->id.'">Sub</span>
          </td>
        </tr>
        ';
        $i++;
      }
      echo $users_list;
    }
  }

  // Update users list
  if(isset($_GET['action']) && $_GET['action'] == 'updateUsersList') {
    update_users_list($_GET['batchCode'], $_GET['role'], $_GET['gender'], $_GET['doj'], $_GET['search'], $_GET['orderBy'], $_GET['ascOrDesc']);
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
