<?php include "../../../config.php";
include "../../layout/header.php"; ?>
<?php
$categories = $conn->query("SELECT * FROM `categories`");
if (isset($_GET['id'])) {
    $posts = $conn->prepare("SELECT * FROM `posts` WHERE `id`=:id");
    $posts->execute(['id' => $_GET['id']]);
    $post = $posts->fetch();
}
$msg_title = '';
$msg_autor = '';
$msg_cat = '';
$msg_img = '';
$msg_body = '';
if (isset($_POST['btnPost'])) {
    if (empty(trim($_POST['title']))) {
        $msg_title = "عنوان را انتخاب کنید.";
    }
    if (empty(trim($_POST['auther']))) {
        $msg_autor = "نویسنده را انتخاب کنید.";
    }
    if (empty(trim($_POST['categoryId']))) {
        $msg_cat = "دسته را انتخاب کنید.";
    }
    if (empty(trim($_FILES['image']['name']))) {
        $msg_img = "تصویر را انتخاب کنید.";
    }
    if (empty(trim($_POST['body']))) {
        $msg_body = "متن را انتخاب کنید.";
    }
    if (
        !empty(trim($_POST['title'])) and !empty(trim($_POST['auther'])) and !empty(trim($_POST['categoryId']))
        and !empty(trim($_FILES['image']['name'])) and !empty(trim($_POST['body']))
    ) {
        $img = $_FILES['image']['name'];
        if (move_uploaded_file($_FILES['image']['tmp_name'], "../../../upload/$img")) {
            $post = $conn->prepare("UPDATE `posts` SET `title`=:t,
        `body`=:b,`category_id`=:c,`auther`=:a,`image`=:i
         WHERE `id`=:id");
            $post->execute(['id' => $_GET['id'], 't' => $_POST['title'], 'b' => $_POST['body'], 'c' => $_POST['categoryId'], 'a' => $_POST['auther'], 'i' => $img]);
            header("Location:index.php");
        }
    } else  if (
        !empty(trim($_POST['title'])) and !empty(trim($_POST['auther'])) and !empty(trim($_POST['categoryId']))
        and !empty(trim($_POST['body']))
    ) {

        $post = $conn->prepare("UPDATE `posts` SET `title`=:t,
        `body`=:b,`category_id`=:c,`auther`=:a
         WHERE `id`=:id");
        $post->execute(['id' => $_GET['id'], 't' => $_POST['title'], 'b' => $_POST['body'], 'c' => $_POST['categoryId'], 'a' => $_POST['auther']]);
        header("Location:index.php");
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Section -->
        <?php include "../../layout/sidebar.php"; ?>
        <!-- Main Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mb-5">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">ویرایش مقاله</h1>
            </div>

            <!-- Posts -->
            <div class="mt-4">
                <form class="row g-4" method="post" enctype="multipart/form-data">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">عنوان مقاله</label>
                        <input
                            type="text"
                            name="title"
                            value="<?= $post['title'] ?>"
                            class="form-control"
                            value="لورم ایپسوم" />
                        <div class="form-text text-danger"><?= $msg_title; ?></div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">نویسنده مقاله</label>
                        <input
                            type="text"
                            name="author"
                            value="<?= $post['author'] ?>"
                            class="form-control"
                            value="علی شیخ" />
                        <div class="form-text text-danger"><?= $msg_autor; ?></div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">دسته بندی مقاله</label>
                        <select class="form-select" name="categoryId">
                            <?php foreach ($categories as $category): ?>
                                <option <?= ($category['id'] == $post['category_id']) ? 'selected' : '' ?> value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="formFile" class="form-label">تصویر مقاله</label>
                        <input class="form-control" type="file" name="image" />
                    </div>

                    <div class="col-12">
                        <label for="formFile" class="form-label">متن مقاله</label>
                        <textarea class="form-control" rows="8" name="body">
                                    <?= $post['body'] ?>   
                                </textarea>
                        <div class="form-text text-danger"><?= $msg_body; ?></div>
                    </div>


                    <div class="col-12 col-sm-6 col-md-4">
                        <img class="rounded" src="../../../upload/<?= $post['image'] ?>" width="300" />
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-dark" name="btnPost">
                            ویرایش
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
    crossorigin="anonymous"></script>
</body>

</html>