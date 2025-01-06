<?php
include "../config.php";
include "./layout/header.php";

if (isset($_GET['action']) && isset($_GET['entity']) && isset($_GET['id'])) {
    // برای حذف کامنت
    if ($_GET['action'] == 'delete' && $_GET['entity'] == 'comments') {
        $sql = $conn->prepare("DELETE FROM `comments` WHERE `id`=:id");
        $query0 = $sql->execute(['id' => $_GET['id']]);
    }

    // برای ویرایش کامنت
    if ($_GET['action'] == 'edit' && $_GET['entity'] == 'comments') {
        $sql = $conn->prepare("UPDATE `comments` SET `status` = '1' WHERE `comments`.`id` = :id;");
        $query0 = $sql->execute(['id' => $_GET['id']]);
    }

    // برای حذف پست
    if ($_GET['action'] == 'delete' && $_GET['entity'] == 'posts') {
        $sql = $conn->prepare("DELETE FROM `posts` WHERE `id`=:id");
        $query1 = $sql->execute(['id' => $_GET['id']]);
    }

    // برای ویرایش پست
    if ($_GET['action'] == 'edit' && $_GET['entity'] == 'posts') {
        $post_sql = $conn->prepare("UPDATE `posts` SET `status` = '1' WHERE `id` = :id");
        $query1 = $post_sql->execute(['id' => $_GET['id']]);
    }
}



if (isset($_GET['action']) && isset($_GET['entity']) && isset($_GET['id'])) {
    // برای حذف دسته‌بندی
    if ($_GET['action'] == 'delete' && $_GET['entity'] == 'categories') {
        $sql = $conn->prepare("DELETE FROM `categories` WHERE `id`=:id");
        $sql->execute(['id' => $_GET['id']]);
    }

    // برای ویرایش دسته‌بندی
    if ($_GET['action'] == 'edit' && $_GET['entity'] == 'categories' && isset($_POST['title'])) {
        $sql = $conn->prepare("UPDATE `categories` SET `title` = :title WHERE `id` = :id");
        $sql->execute(['id' => $_GET['id'], 'title' => $_POST['title']]);
    }
}

// استخراج دسته‌بندی‌ها
$categories = $conn->query("SELECT * FROM `categories` ORDER BY id DESC LIMIT 3");
$comments = $conn->query("SELECT * FROM `comments` ORDER BY id DESC LIMIT 3");
$posts = $conn->query("SELECT * FROM `posts` ORDER BY id DESC LIMIT 3");
?>


<!-- Recently Posts -->



<div class="container-fluid">
    <div class="row">
        <?php include "./layout/sidebar.php"; ?>

        <!-- Main Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div
                class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">داشبورد </h1>

            </div>


            <!-- Recently Posts -->
            <div class="mt-4">
                <h4 class="text-secondary fw-bold">مقالات اخیر</h4>
                <div class="table-responsive small">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>عنوان</th>
                                <th>نویسنده</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // فرض می‌کنیم جدول مقالات `posts` نام دارد
                            $posts = $conn->query("SELECT * FROM `posts` ORDER BY id DESC LIMIT 3");
                            foreach ($posts as $post):
                            ?>
                                <tr>
                                    <th><?= $post['id']; ?></th>
                                    <td><?= $post['title']; ?></td>
                                    <td><?= $post['author']; ?></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-dark">ویرایش</a>
                                        <a href="?action=delete&entity=posts&id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Recently Comments -->
            <div class="mt-4">
                <h4 class="text-secondary fw-bold">کامنت های اخیر</h4>
                <div class="table-responsive small">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>نام</th>
                                <th>متن کامنت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($comments as $comment): ?>
                                <tr>
                                    <th><?= $comment['id']; ?></th>
                                    <td><?= $comment['name']; ?> </td>
                                    <td>
                                        <?= $comment['comment']; ?>
                                    </td>
                                    <td>
                                        <?php if ($comment['status'] == 1): ?>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-dark disabled">تایید شده</a>
                                        <?php elseif ($comment['status'] == 0): ?>
                                            <a
                                                href="?action=edit&entity=comments&id=<?= $comment['id'] ?>"
                                                class="btn btn-sm btn-outline-info">در انتظار تایید</a>
                                        <?php endif; ?>
                                        <a
                                            href="?action=delete&entity=comments&id=<?= $comment['id'] ?>"
                                            class="btn btn-sm btn-outline-danger">حذف</a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Categories -->
            <div class="mt-4">
    <h4 class="text-secondary fw-bold">دسته بندی‌ها</h4>
    <div class="table-responsive small">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>id</th>
                    <th>عنوان</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $categories = $conn->query("SELECT * FROM `categories` ORDER BY id DESC");
                foreach ($categories as $category): ?>
                    <tr>
                        <th><?= $category['id']; ?></th>
                        <td><?= $category['title']; ?></td>
                        <td>
                            <a href="?action=edit&entity=categories&id=<?= $category['id'] ?>" class="btn btn-sm btn-outline-dark">ویرایش</a>
                            <a href="?action=delete&entity=categories&id=<?= $category['id'] ?>" class="btn btn-sm btn-outline-danger">حذف</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>


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