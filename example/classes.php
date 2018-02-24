<?php
  class Car {
    function Car() {
      $this->model = 'x5';
    }
  }

  // create an object
  $BMW = new Car();

  // show object properties
  echo $BMW->model;
 ?>
