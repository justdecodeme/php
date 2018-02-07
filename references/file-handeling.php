<?php 
	$file = fopen('demo.txt', 'w');
	$text = 'Hi, How are you?';
	fwrite($file, $text);
	fclose($file);
 ?>