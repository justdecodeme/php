<?php
// echo and print are more or less the same. They are both used to output data to the screen.
// echo is marginally faster than print.

// The echo and print statement can be used with or without parentheses.
echo "<h1>PHP is Fun!</h1>";
echo('Good to see you.<br>');
print '<h2>PHP is easy!</h2>';
print ('You doing great.<br>');

// echo can take multiple parameters (although such usage is rare) while print can take one argument.
echo "This ", "string ", "was ", "made ", "with multiple parameters.<br>";

// The differences are small: echo has no return value while print has a return value of 1 so
// it can be used in expressions.
// var_dump(echo 'Print<br>'); // ERROR
var_dump(print 'Print<br>');
 ?>
