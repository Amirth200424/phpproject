<?php include("config.php"); ?>
<?php include("layout/header.php") ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $posts = $conn->prepare("SELECT * FROM `posts` WHERE `id`=:id;");
    $posts->execute(['id' => $id]);
    $post = $posts->fetch();
    $cat_id = $post['category_id'];
    $sql_cat = "SELECT * FROM `categories` WHERE `id` = $cat_id";
    $cat = $conn->query($sql_cat)->fetch();
} else {
    header('location:index.php');
}
?>
<main>
    <!-- Content -->
    <section class="mt-4">
        <div class="row">
            <!-- Posts & Comments Content -->
            <div class="col-lg-8">
                <div class="row justify-content-center">
                    <!-- Post Section -->
                    <div class="col">
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
                                    class="card-text text-secondary text-justify pt-3">
                                    <?= $post['body']; ?>
                                </p>
                                <div>
                                    <p class="fs-6 mt-5 mb-0">
                                        نویسنده : <?= $post['author']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-4" />

                    <!-- Comment Section -->
                    <div class="col">
                        <!-- Comment Form -->
                        <div class="card">
                            <div class="card-body">
                                <p class="fw-bold fs-5">
                                    ارسال کامنت
                                </p>

                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">نام</label>
                                        <input
                                            type="text"
                                            class="form-control" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">متن کامنت</label>
                                        <textarea
                                            class="form-control"
                                            rows="3"></textarea>
                                    </div>
                                    <button
                                        type="submit"
                                        class="btn btn-dark">
                                        ارسال
                                    </button>
                                </form>
                            </div>
                        </div>

                        <hr class="mt-4" />
                        <!-- Comment Content -->
                        <?php
                        $comments = $conn->prepare("SELECT * FROM `comments` WHERE `post_id`=:id AND`status`=1;");
                        $comments->execute(['id' => $post['id']]);

                        ?>
                        <p class="fw-bold fs-6">تعداد کامنت : <?= $comments->rowCount(); ?></p>
                        <?php
                        foreach ($comments as $comment):
                        ?>

                            <div class="card bg-light-subtle mb-3">
                                <div class="card-body">
                                    <div
                                        class="d-flex align-items-center">
                                        <img
                                            src="./assets/images/profile.png"
                                            width="45"
                                            height="45"
                                            alt="user-profle" />

                                        <h5
                                            class="card-title me-2 mb-0">
                                            <?= $comment['name']; ?>
                                        </h5>
                                    </div>

                                    <p class="card-text pt-3 pr-3">
                                        <?= $comment['comment']; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if ($comments->rowCount() == 0) { ?>
                            <div class="alert alert-danger">
                                کامنت پیدا نشد !!!!
                            </div>
                        <?php } ?>


                    </div>
                </div>
            </div>

            <!-- Sidebar Section -->
            <?php include "layout/sidebar.php"; ?>
        </div>
    </section>
</main>

<!-- Footer -->

<?php include "./layout/footer.php"; ?>