<?php

if (isset($_COOKIE['login'])) {
    echo 'looged!';
} else {
    header('location: login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>

<body>
    <h1>Welcome Posts!</h1>
    <?php
    // echo $_COOKIE['login'];
    ?>
</body>

</html>