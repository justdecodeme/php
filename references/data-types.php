<?php
  class Car {
    function Car() {
      $this->model = 'x5';
    }
  }

  // integer
  $a = 5;
  // float also called double
  $b = 3.14;
  // string
  $c = 'php';
  // boolean
  $d = true;
  // array
  $e = array('php', 'mysql');
  // null
  $f = null;
  // object
  $g = new Car();
  // ERROR
  $h;

  var_dump($a);

  // constants (are automatically global)
  define('PI', 3.14, true); // true -> case-insensitive, default is false (case sensitive)
  var_dump(pi); // float(3.14)
 ?>
