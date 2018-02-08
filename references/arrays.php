<?php

	# Indexed arrays - Arrays with a numeric index
	$subjects = array('php', 'nodejs', 'python');
	echo $subjects[0] . '<br>';
	# Loop Through an Indexed Array
	$arrlength = count($subjects);

	for($x = 0; $x < $arrlength; $x++) {
	    echo $subjects[$x];
	    echo "<br>";
	}	

	# Associative arrays - Arrays with named keys
	$subjectsLevel = array("php"=>"easy", "nodejs"=>"medium", "js"=>"very easy");
	echo $subjectsLevel['php'] . '<br>';
	# Loop Through an Associative Array
	foreach($subjectsLevel as $key => $value) {
	    echo "Key=" . $key . ", Value=" . $value;
	    echo "<br>";
	}	
?>
