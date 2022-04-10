<?php
$page_title = 'Add User';

require '../includes/header.php';

// <!-- Start DB Connect -->

$error = $name = $email = $age = $password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = vali_input($_POST["name"]);
    $email = vali_input($_POST["email"]);
    $age = vali_input($_POST["age"]);
    $password = vali_input($_POST["password"]);

    $sql = "INSERT INTO users (name, email, age, password) VALUES ('$name', '$email', '$age', '$password')";

    // die($sql);

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $conn = null;

    header('location: users.php');
    die();
}


// <!-- End BD Connect -->
?>
<div class="container-fluid">
    <div class="row">

        <?php require '../includes/sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


            <h2 class="mt-5">Add Users
                <a class="float-end h6" href="/admin/users/">Back to Users</a>
            </h2>

            <div class="card">
                <div class="card-body">
                    <form method="post" class="row g-3">
                        <div class="col-md-6">
                            <label for="inputName4" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputName4" name="name">
                        </div>
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" name="email">
                        </div>
                        <div class="col-md-6">
                            <label for="inputAge4" class="form-label">Age</label>
                            <input type="number" class="form-control" id="inputAge4" name="age">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Password</label>
                            <input type="password" class="form-control" id="inputPassword4" name="password">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit User</button>
                        </div>
                    </form>
                </div>
            </div>


        </main>
    </div>
</div>

<?php

require '../includes/footer.php';
