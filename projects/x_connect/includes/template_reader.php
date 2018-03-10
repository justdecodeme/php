<?php
  $url = '_assets/js/batch_templates.json'; // path to your JSON file
  $data_str = file_get_contents($url); // put the contents of the file into a variable
  $batch_obj = json_decode($data_str, true); // decode the JSON feed
?>
<script>
  var batchData = <?php echo $data_str; ?>;
  // console.log(batchData);
</script>
