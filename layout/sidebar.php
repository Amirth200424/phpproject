<!-- Sidebar Section -->
<div class="col-lg-4">
    <!-- Sesrch Section -->
    <div class="card">
        <div class="card-body">
            <p class="fw-bold fs-6">جستجو در وبلاگ</p>
            <form action="search.php" method="get">
                <div class="input-group mb-3">
                    <input
                        type="text"
                        class="form-control"
                        name="search"
                        placeholder="جستجو ..." />
                    <button
                        class="btn btn-secondary"
                        type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Categories Section -->
 
    <div class="card mt-4">
    <div class="fw-bold fs-6 card-header">دسته بندی ها</div>
    <ul class="list-group list-group-flush p-0">
        <?php
        $sql_categories = "SELECT * FROM `categories`";
        $categories = $conn->query($sql_categories);
        if ($categories->rowCount() > 0):
            foreach ($categories as $category):
        ?>
            <li class="list-group-item">
                <a
                    class="link-body-emphasis text-decoration-none"
                    href="index.php?cat_id=<?= $category['id']; ?>">
                    <?= $category['title']; ?>
                </a>
            </li>
        <?php endforeach; endif; ?>
    </ul>
</div>


    <!-- Subscribue Section -->
    <div class="card mt-4">
        <div class="card-body">
            <p class="fw-bold fs-6">عضویت در خبرنامه</p>

            <form>
                <div class="mb-3">
                    <label class="form-label">نام</label>
                    <input
                        type="text"
                        class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">ایمیل</label>
                    <input
                        type="email"
                        class="form-control" />
                </div>
                <div class="d-grid gap-2">
                    <button
                        type="submit"
                        class="btn btn-secondary">
                        ارسال
                    </button>
                </div>
            </form>
        </div>
    </div>





 

    <!-- About Section -->
    <div class="card mt-4">
        <div class="card-body">
            <p class="fw-bold fs-6">درباره ما</p>
            <p class="text-justify">
                لورم ایپسوم متن ساختگی با تولید سادگی
                نامفهوم از صنعت چاپ و با استفاده از
                طراحان گرافیک است. چاپگرها و متون بلکه
                روزنامه و مجله در ستون و سطرآنچنان که
                لازم است و برای شرایط فعلی تکنولوژی مورد
                نیاز و کاربردهای متنوع با هدف بهبود
                ابزارهای کاربردی می باشد.
            </p>
        </div>
    </div>
</div>