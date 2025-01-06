<?php include("config.php"); ?>
<?php include("layout/header.php") ?>
<?php
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $posts = $conn->prepare("SELECT * FROM `posts` WHERE `title` LIKE :title;");
    $posts->execute(['title' => "%$search%"]);
    //   print_r($posts->fetchAll());

}
?>
<main>
    <!-- Content Section -->
    <section class="mt-4">
        <div class="row">
            <!-- Posts Content -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col">
                        <div class="alert alert-secondary">
                            پست های مرتبط با کلمه [ <?= $_GET['search']; ?> ]
                        </div>

                        <?php if ($posts->rowCount() == 0) { ?>
                            <div class="alert alert-danger">
                                مقاله مورد نظر پیدا نشد !!!!
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="row g-3">
                    <?php
                    foreach ($posts as $post):
                        $cat_id = $post['category_id'];
                        $sql_cat = "SELECT * FROM `categories` WHERE `id` = $cat_id";
                        $cat = $conn->query($sql_cat)->fetch();
                    ?>
                        <div class="col-sm-6">
                            <div class="card">
                                <img
                                    src="./upload/<?= $post['image']; ?>"
                                    class="card-img-top"
                                    alt="post-image" />
                                <div class="card-body">
                                    <div
                                        class="d-flex justify-content-between">
                                        <h5 class="card-title fw-bold">
                                            <?= $post['title']; ?>
                                        </h5>
                                        <div>
                                            <span
                                                class="badge text-bg-secondary"><?= $cat['title']; ?></span>
                                        </div>
                                    </div>
                                    <p
                                        class="card-text text-secondary pt-3">
                                        <?= substr($post['body'], 0, 200), '...'; ?>
                                    </p>
                                    <div
                                        class="d-flex justify-content-between align-items-center">
                                        <a
                                            href="single.php?id=<?= $post['id'] ?>"
                                            class="btn btn-sm btn-dark">مشاهده</a>

                                        <p class="fs-7 mb-0">
                                            نویسنده : <?= $post['author']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- Sidebar Section -->
            <?php include "layout/sidebar.php"; ?>
        </div>
    </section>
</main>

<!-- Footer Section -->
<?php include "./layout/footer.php"; ?>