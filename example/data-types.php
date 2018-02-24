<?php
  class Car {
    function Car() {
      $this->model = 'x5';
    }
  }

  // integer
  $a = 5;
  // float
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

  var_dump($g);
 ?>
