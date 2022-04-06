<?php

if (isset($_COOKIE['login'])) {
    header('location: admin/index.php');
}

function vali_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$error = $email = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["name"])) {
        $error .= "Name is required<br>";
    } else {
        $name = vali_input($_POST["name"]);

        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $error .= "Only letters and white space allowed<br>";
        }
    }

    if (empty($_POST["email"])) {
        $error .= "Email is required<br>";
    } else {
        $email = vali_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error .= "Invalid email format<br>";
        }
    }

    $age = vali_input($_POST["age"]);
    if (!filter_var($age, FILTER_VALIDATE_INT) && !empty($age)) {
        $error .= "Invalid age format<br>";
    }


    if (empty($_POST["password"])) {
        $error .= "Password is required<br>";
    } else {
        $password = vali_input($_POST["password"]);
        if (strlen($password) < 6 || strlen($password) > 10) {
            $error .= "Password must be between 6 and 10 letters<br>";
        }
    }

    if (empty($error)) {
        // echo '<h1>insert into DB</h1>';
        $db_servername = "localhost";
        $db_username = "root";
        $db_password = "root";
        $db_name = "php67";

        try {
            $conn = new PDO("mysql:host=$db_servername;dbname=$db_name", $db_username, $db_password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // End Connction Query

            // Insert Query
            // $sql = "INSERT INTO users (name, email, age, password) VALUES ('$name', '$email', $age, $password')"; // IN case I have Age
            // $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', $password')"; IN case I don't have age
            $sql = "INSERT INTO users (name, email, " . ($age ?  'age,' : '') . " password) VALUES ('$name', '$email', " . ($age ? ($age . ',') : '') . " '$password')";

            // use exec() because no results are returned
            $conn->exec($sql);
            $conn = null;
            // echo "<h1>Inserted successfully</h1>";
            $expire = $_POST['remeber'] ? time() + (86400 * 30) : time() + 86400;

            setcookie('login', 'logged', $expire);

            header('location: admin/index.php');
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    print_r($_POST);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Register Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/safari-pinned-tab.svg" color="#7952b3">
    <link rel="icon" href="https://getbootstrap.com/docs/5.0/assets/img/favicons/favicon.ico">
    <meta name="theme-color" content="#7952b3">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">

    <main class="form-signin">
        <form method="post" action="register.php">
            <img class="mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please Register</h1>

            <small class="error text-danger"><?= $error; ?></small>

            <div class="form-floating">
                <input name="name" type="name" class="form-control" id="floatingName" placeholder="name@example.com" value="<?= isset($name) ? $name : '' ?>">
                <label for="floatingName">Name</label>
            </div>

            <div class="form-floating">
                <input name="email" type="email" class="form-control" id="floatingEmail" placeholder="name@example.com" value="<?= $email ?>">
                <label for="floatingEmail">Email address</label>
            </div>

            <div class="form-floating">
                <input name="age" type="age" class="form-control" id="floatingage" placeholder="age" value="<?= isset($age) ? $age : '' ?>">
                <label for="floatingage">Age</label>
            </div>

            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password" value="<?= $password ?>">
                <label for="floatingPassword">Password</label>
            </div>

            <div class="checkbox mb-3">
                <label>
                    <input name="remeber" type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
        </form>
    </main>



</body>

</html>