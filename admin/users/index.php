<?php
$page_title = 'Users';

require '../includes/header.php';
?>
<div class="container-fluid">
    <div class="row">

        <?php require '../includes/sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <!-- Start DB Connect -->
            <?php

            $users = $conn->query("SELECT id,name,email FROM users");

            $users = $users->fetchAll();

            // print_r($users);

            // for ($i= 0; count($user) > $i; $i++)
            // foreach ($users as $user)
            // foreach ([1, 2, 3, 4, 5] as $number)

            ?>
            <!-- End BD Connect -->

            <h2 class="mt-5">Users
                <a class="float-end h6" href="/admin/users/add-user.php">Add User</a>
            </h2>
            <div class="table-responsive pt-3 pb-2 mb-3 border-bottom">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($users as $user) : ?>

                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['name'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td>
                                    <div class="btn-group">

                                        <!-- <form action="show-user.php" method="get">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <input type="hidden" name="email" value="<?= $user['email'] ?>">
                                            <button class="btn btn-outline-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </form> -->
                                        <a href="show-user.php?id=<?= $user['id'] ?>&email=<?= $user['email'] ?>" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="edit-user.php?id=<?= $user['id'] ?>" class="btn btn-outline-info btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="index.php?delete=yes&id=<?= $user['id'] ?>" class="btn btn-danger btn-sm sa-btn-delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        <!-- <?php foreach ($users as $user) {
                                    echo "
                            <tr>
                                <td>" . $user['id'] . "</td>
                                <td>" . $user['name'] . "</td>
                                <td>" . $user['email'] . "</td>
                                <td>placeholder</td>
                            </tr>
                            ";
                                } ?> -->

                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

<?php

require '../includes/footer.php';
