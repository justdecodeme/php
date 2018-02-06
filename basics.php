<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Basics</title>
</head>
<body>
	<?php
		// for all information about php (never use in production)
		// phpinfo();

		// language constructors
		echo "PHP is very easy!<br>";

		print_r("I will be master in PHP in some days!<br>");

		$date  = 13;
		$month = 'May';
		// double quotes support variables
		echo "My Birthday is on $date $month every year!<br>";
		// in single quotes, we've to use concatenation
		echo 'My Birthday is on '. $date . $month . ' every year!';
	?>
</body>
</html>
