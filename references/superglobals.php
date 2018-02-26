<?php
// Several predefined variables in PHP are "superglobals", which means that they are always
// accessible, regardless of scope - and you can access them from any function, class or
// file without having to do anything special.

// The PHP Global Variables (superglobal) variables are:

// $GLOBALS
// $_SERVER
// $_REQUEST
// $_POST
// $_GET
// $_FILES
// $_ENV
// $_COOKIE
// $_SESSION

echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];
 ?>
