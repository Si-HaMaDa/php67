<?php
$page_title = 'Add Blog';

require '../includes/header.php';

// <!-- Start DB Connect -->

$error = $title = $content = $image = $user_id = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = vali_input($_POST["title"]);
    $content = vali_input($_POST["content"]);
    $image = $_FILES["image"];
    $user_id = vali_input($_POST["user_id"]);

    $image_name = $image['name'];
    $target_file = '../images/blogs/' . $image_name;
    move_uploaded_file($image['tmp_name'], $target_file);

    $sql = "INSERT INTO blogs (title, content, image, user_id) VALUES ('$title', '$content', '$image_name', '$user_id')";

    // die($sql);

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $conn = null;

    header('location: index.php');
    die();
}


// <!-- End BD Connect -->
?>
<div class="container-fluid">
    <div class="row">

        <?php require '../includes/sidebar.php'; ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">


            <h2 class="mt-5">Add Blog
                <a class="float-end h6" href="/admin/blogs/">Back to Blog</a>
            </h2>

            <div class="card">
                <div class="card-body">
                    <form method="post" class="row g-3" enctype="multipart/form-data">
                        <div class="col-md-6">
                            <label for="inputTitle4" class="form-label">Title</label>
                            <input type="text" class="form-control" id="inputTitle4" name="title">
                        </div>
                        <div class="col-md-12">
                            <label for="inputContent4" class="form-label">Content</label>
                            <textarea class="form-control" name="content" id="inputContent4" cols="30" rows="10"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="inputImage4" class="form-label">Image</label>
                            <input type="file" class="form-control" id="inputImage4" name="image">
                        </div>
                        <div class="col-md-6">
                            <label for="inputUserID4" class="form-label">UserID</label>
                            <input type="number" class="form-control" id="inputUserID4" name="user_id">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit Blog</button>
                        </div>
                    </form>
                </div>
            </div>


        </main>
    </div>
</div>

<?php

require '../includes/footer.php';
