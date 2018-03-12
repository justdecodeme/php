<?php
  $url = '_assets/js/batch_templates_forPHP.json'; // path to your JSON file
  $data_str = file_get_contents($url); // put the contents of the file into a variable
  $batch_obj = json_decode($data_str, true); // decode the JSON feed
?>
