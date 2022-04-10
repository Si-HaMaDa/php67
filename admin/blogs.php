<?php
$page_title = 'Blogs';

require './includes/header.php';
?>
<div class="container-fluid">
    <div class="row">

        <?php require './includes/sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <!-- Start DB Connect -->
            <!-- End BD Connect -->

            <h2 class="mt-5">Blogs</h2>
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
                    </tbody>
                </table>
            </div>

        </main>
    </div>
</div>

<?php

require './includes/footer.php';
