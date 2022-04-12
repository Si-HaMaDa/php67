<?php
$page_title = 'Blogs';

require '../includes/header.php';

// Start Delete Blog
// isset()
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM blogs WHERE id=$id");
}
// End Delete Blog

// Start Pagination Variables

$per_page = 5;

$start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

$total_blogs_count = $conn->query("SELECT COUNT(id) FROM blogs");
$total_blogs_count = (int)$total_blogs_count->fetchColumn();

$total_pages = ceil($total_blogs_count / $per_page);

$current_page = $start / $per_page + 1;

// End Pagination Variables

?>
<div class="container-fluid">
    <div class="row">

        <?php require '../includes/sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <!-- Start DB Connect -->
            <?php

            $blogs = $conn->query("SELECT id, title,image FROM blogs ORDER BY id DESC LIMIT $per_page OFFSET $start");
            $blogs = $blogs->fetchAll();

            ?>
            <!-- End BD Connect -->

            <h2 class="mt-5">Blogs
                <a class="float-end h6 btn btn-primary btn-sm" href="/admin/blogs/add-blog.php">Add Blog</a>
            </h2>
            <div class="table-responsive pt-3 pb-2 mb-3 border-bottom">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($blogs as $blog) : ?>

                            <tr>
                                <td><?= $blog['id'] ?></td>
                                <td><?= $blog['title'] ?></td>
                                <td>
                                    <img width="200" src="../images/blogs/<?= $blog['image'] ?>" alt="<?= $blog['title'] ?>" srcset="../images/blogs/<?= $blog['image'] ?>">
                                </td>
                                <td>
                                    <a href="/admin/blogs/show-blog.php?id=<?= $blog['id'] ?>" class="btn btn-outline-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <a href="/admin/blogs/edit-blog.php?id=<?= $blog['id'] ?>" class="btn btn-outline-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="/admin/blogs/index.php?delete=<?= $blog['id'] ?>" class="btn btn-danger btn-sm sa-btn-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

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
