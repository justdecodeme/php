<?php
    // if(isset($_POST['submit'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $msg = $_POST['msg'];
        $sub = $_POST['sub'];

        // $to = 'contact@weball.io';
        $to = 'hashrakeshkumar@gmail.com';
        $message = $msg;
        $headers = "From: " . $email;

        if(empty($name) || empty($email) || empty($msg)) {
            echo "Please fill all the fields";
        }

        if(mail($to, $sub, $message, $headers)) {
            echo "Sent Successfully!";
        } else {
            echo "Something went wrong!";
        }
    // }
?>