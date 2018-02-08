<?php 
	// simple function
	function sayHi() {
		echo "Hi from function! <br>";
	}
	sayHi();

	// function with arguments
	function sayName($fname) {
	    echo "Welcome $fname <br>";
	}
	sayName("Sofia");	

	// function with default arguments
	function square($x = 3) {
	    echo "Square of $x is " . $x*$x . '<br>';
	}
	square(4);	
	square();	

	// function with returning statements
	function sum($x = 3, $y = 4) {
	    return $x + $y;
	}
	echo "5 + 7 is " . sum(5, 7) . '<br>'
 ?>