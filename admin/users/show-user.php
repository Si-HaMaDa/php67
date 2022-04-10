<?php
$page_title = 'Show User';

require '../includes/header.php';
?>
<div class="container-fluid">
    <div class="row">

        <?php require '../includes/sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <!-- Start DB Connect -->
            <?php

            // Check and get id
            $id = isset($_GET['id']) ? (int)$_GET['id'] : '';

            // If not have $id get back to users.php
            if (empty($id)) header('location: users.php');

            $users = $conn->query("SELECT * FROM users WHERE id=$id");

            $users = $users->fetchAll();

            ?>
            <!-- End BD Connect -->

            <h2 class="mt-5">Users
                <a class="float-end h6" href="/admin/users/">Back to Users</a>
            </h2>
            <div class="table-responsive pt-3 pb-2 mb-3 border-bottom">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Age</th>
                            <th scope="col">Registration date</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($users as $user) : ?>

                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['age'] ?></td>
                                <td><?= $user['reg_date'] ?></td>
                            </tr>

                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

<?php

require '../includes/footer.php';
