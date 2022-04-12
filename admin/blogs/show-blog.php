<?php
$page_title = 'Show Blog';

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

            // If not have $id get back to blogs.php
            if (empty($id)) header('location: index.php');

            $blog = $conn->query("SELECT * FROM blogs WHERE id=$id");

            $blog = $blog->fetch();

            ?>
            <!-- End BD Connect -->

            <h2 class="mt-5">Blogs
                <a class="float-end h6" href="/admin/blogs/">Back to Blogs</a>
            </h2>
            <div class="table-responsive pt-3 pb-2 mb-3 border-bottom">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Image</th>
                            <th scope="col">User ID</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><?= $blog['id'] ?></td>
                                <td><?= $blog['title'] ?></td>
                                <td><?= $blog['content'] ?></td>
                                <td><?= $blog['image'] ?></td>
                                <td><?= $blog['user_id'] ?></td>
                            </tr>
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

<?php

require '../includes/footer.php';
