 <?php include("config.php"); 
include("layout/header.php") ;
$sql = "SELECT * FROM `posts_slider`";
$slider = $conn->query($sql);
?>
 <main>
     <!-- Slider Section -->
     <section>
         <div id="carousel" class="carousel slide">
             <div class="carousel-indicators">
                 <button
                     type="button"
                     data-bs-target="#carousel"
                     data-bs-slide-to="0"
                     class="active"></button>
                 <button
                     type="button"
                     data-bs-target="#carousel"
                     data-bs-slide-to="1"></button>
                 <button
                     type="button"
                     data-bs-target="#carousel"
                     data-bs-slide-to="2"></button>
             </div>
             <div class="carousel-inner rounded">
                 <?php
                    $sql = "SELECT * FROM `posts_slider`";
                    $slider = $conn->query($sql);
                    if ($slider->rowCount() > 0):
                        foreach ($slider as $sld):
                            $id = $sld['post_id'];
                            $sql = "SELECT * FROM `posts` WHERE `id` = $id";
                            $post = $conn->query($sql);
                            $psd = $post->fetch();
                    ?>

                         <div
                             class="carousel-item overlay carousel-height <?= ($sld['active']) ? 'active' : '' ?>">
                             <img
                                 src="./upload/<?php echo $psd['image']; ?>"
                                 class="d-block w-100"
                                 alt="post-image" />
                             <div class="carousel-caption d-none d-md-block">
                                 <h5>
                                     <?= $psd['title']; ?>
                                 </h5>
                                 <p>
                                     <?= substr($psd['body'], 0, 200,), '...'; ?>
                                 </p>
                             </div>
                         </div>
                     <?php endforeach; ?>
                 <?php endif; ?>
                
             </div>
             <button
                 class="carousel-control-prev"
                 type="button"
                 data-bs-target="#carousel"
                 data-bs-slide="prev">
                 <span class="carousel-control-prev-icon"></span>
                 <span class="visually-hidden">Previous</span>
             </button>
             <button
                 class="carousel-control-next"
                 type="button"
                 data-bs-target="#carousel"
                 data-bs-slide="next">
                 <span class="carousel-control-next-icon"></span>
                 <span class="visually-hidden">Next</span>
             </button>
         </div>
     </section>

     <!-- Content Section -->
     <section class="mt-4">
         <div class="row">
             <!-- Posts Content -->
             <div class="col-lg-8">
                 <div class="row g-3">
                     <?php
                        if (isset($_GET['cat_id'])) {
                            $posts = $conn->prepare("SELECT * FROM `posts` WHERE `category_id` = :id ORDER BY `category_id` ASC");
                            $posts->execute(['id' => $_GET['cat_id']]);
                        } else {
                            $sql_post = "SELECT * FROM `posts` ORDER BY 'id' DESC";
                            $posts = $conn->query($sql_post);
                        }

                        if ($posts->rowCount() > 0):
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
                     <?php endif; ?>

                 </div>
             </div>

             <?php include "layout/sidebar.php"; ?>
         </div>
     </section>
 </main>
 <?php include "./layout/footer.php"; ?>