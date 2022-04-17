<?php
$page_title = 'Users';

require '../includes/header.php';

// Start Delete User
// isset()
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header('location: index.php');
}
// End Delete User


// Start Pagination Variables

$per_page = 5;

$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

$total_users = $conn->query("SELECT id FROM users");
$total_users = $total_users->fetchAll();

$total_pages = ceil(count($total_users) / $per_page);

$current_page = $start / $per_page + 1;

// $total_users_count = $conn->query("SELECT COUNT(id) FROM users");
// $total_users_count = $total_users_count->fetchColumn();

// End Pagination Variables



?>
<div class="container-fluid">
    <div class="row">

        <?php require '../includes/sidebar.php';
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <!-- Start DB Connect -->
            <?php

            $users = $conn->query("SELECT id,name,email FROM users ORDER BY id ASC LIMIT $per_page OFFSET $start");

            $users = $users->fetchAll();
            $conn = null;

            // print_r($users);

            // for ($i= 0; count($user) > $i; $i++)
            // foreach ($users as $user)
            // foreach ([1, 2, 3, 4, 5] as $number)

            ?>
            <!-- End BD Connect -->

            <h2 class="mt-5">Users
                <a class="float-end h6 btn btn-primary btn-sm" href="/admin/users/add-user.php">Add User</a>
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
                                        <a href="/admin/users/show-user.php?id=<?= $user['id'] ?>&email=<?= $user['email'] ?>" class="btn btn-outline-primary btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="/admin/users/edit-user.php?id=<?= $user['id'] ?>" class="btn btn-outline-info btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <a href="/admin/users/index.php?delete=<?= $user['id'] ?>" class="btn btn-danger btn-sm sa-btn-delete">
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

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="?strat=0" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php //for ($i = $current_page - 2; $i < $current_page + 1; $i++) : 
                    ?>
                    <?php for ($i = 0; $i < $total_pages; $i++) : ?>
                        <li class="page-item <?= $current_page == ($i + 1) ? "active" : "" ?>">
                            <a class="page-link" href="?start=<?= $i * $per_page ?>">
                                <?= $i + 1 ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item">
                        <a class="page-link" href="?start=<?= ($total_pages - 1) * $per_page ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </main>
    </div>
</div>

<?php

require '../includes/footer.php';
