<?php require 'includes/header.php'; ?>

<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Blog Home!</h1>
            <p class="lead mb-0">A Bootstrap 5 starter layout for your next blog homepage</p>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="row">
        <!-- Blog entries-->
        <div class="col-lg-8">
            <!-- Nested row for non-featured blog posts-->
            <div class="row">
                <!-- Start DB Connect -->
                <?php

                // Start Pagination Variables

                $per_page = 4;

                $start = isset($_GET['start']) ? (int)$_GET['start'] : 0;

                $total_blogs_count = $conn->query("SELECT COUNT(id) FROM blogs");
                $total_blogs_count = (int)$total_blogs_count->fetchColumn();

                $total_pages = ceil($total_blogs_count / $per_page);

                $current_page = $start / $per_page + 1;

                // End Pagination Variables

                $blogs = $conn->query("SELECT id, title, content, image FROM blogs ORDER BY id DESC LIMIT $per_page OFFSET $start");
                $blogs = $blogs->fetchAll();

                ?>
                <!-- End BD Connect -->
                <?php foreach ($blogs as $blog) : ?>
                    <div class="col-lg-6">
                        <!-- Blog post-->
                        <div class="card mb-4">
                            <a href="single.php"><img class="card-img-top" src="<?= !empty($blog['image']) ? "admin/images/blogs/" . $blog['image'] : "https://dummyimage.com/700x350/dee2e6/6c757d.jpg" ?>" alt="..." /></a>
                            <div class="card-body">
                                <!-- <div class="small text-muted">January 1, 2022</div> -->
                                <h2 class="card-title h4"><?= $blog['title'] ?></h2>
                                <p class="card-text">
                                    <?= substr($blog['content'], 0, 100) ?>...
                                </p>
                                <a class="btn btn-primary" href="single.php?id=<?= $blog['id'] ?>">Read more →</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0" />
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a></li>

                    <?php for ($i = 0; $i < $total_pages; $i++) : ?>
                        <li class="page-item <?= $current_page == ($i + 1) ? 'active' : '' ?>" aria-current="page">
                            <a class="page-link" href="?start=<?= $i * $per_page ?>"><?= $i + 1 ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                </ul>
            </nav>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Web Design</a></li>
                                <li><a href="#!">HTML</a></li>
                                <li><a href="#!">Freebies</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to
                    use, and feature the Bootstrap 5 card component!</div>
            </div>
        </div>
    </div>
</div>

<?php require 'includes/footer.php';
