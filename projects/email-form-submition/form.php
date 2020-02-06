<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Form Submition using PHP</title>
    <style>
        form {
            width: 400px;
            margin: 50px auto;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>PHP Form</h1>
    <form action="mail-handler.php" method="post">
        <input type="text" name="name" placeholder="name"> 
        <br>
        <br>
        <input type="email" placeholder="email" name="email">
        <br>
        <br>
        <input type="sub" placeholder="sub" name="sub">
        <br>
        <br>
        <textarea name="msg" id="msg" cols="30" rows="10" placeholder="message"></textarea>
        <br>
        <br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>