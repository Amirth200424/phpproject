<?php include "../config.php"; 
 include "./layout/header.php"; ?>
 <?php 
 if(isset($_GET['action']) and isset($_GET['entity']) and isset($_GET['id']))
 {
    if($_GET['action'] == 'delete' and $_GET['entity']== 'comments')
    {
        $sql = $conn->prepare("DELETE FROM `comments` WHERE `id`=:id");
    }

    if($_GET['action'] == 'edit' and $_GET['entity']== 'comments')
    {
        $sql = $conn->prepare("UPDATE `comments` SET `status` = '1' WHERE `comments`.`id` = :id;");
    }
    
    $query = $sql->execute(['id'=>$_GET['id']]);
 }
 $comments = $conn->query("SELECT * FROM `comments` ORDER BY id DESC LIMIT 3");
 ?>

        <div class="container-fluid">
            <div class="row">
            <?php include "./layout/sidebar.php"; ?>   

                <!-- Main Section -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <div
                        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
                    >
                        <h1 class="fs-3 fw-bold">داشبورد</h1>
                        
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
                                    <tr>
                                        <th>1</th>
                                        <td>لورم ایپسوم متن ساختگی</td>
                                        <td>علی شیخ</td>
                                        <td>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-dark"
                                                >ویرایش</a
                                            >
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-danger"
                                                >حذف</a
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>لورم ایپسوم متن</td>
                                        <td>علی شیخ</td>
                                        <td>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-dark"
                                                >ویرایش</a
                                            >
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-danger"
                                                >حذف</a
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>لورم ایپسوم متن ساختگی</td>
                                        <td>علی شیخ</td>
                                        <td>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-dark"
                                                >ویرایش</a
                                            >
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-danger"
                                                >حذف</a
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>4</th>
                                        <td>لورم ایپسوم</td>
                                        <td>علی شیخ</td>
                                        <td>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-dark"
                                                >ویرایش</a
                                            >
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-danger"
                                                >حذف</a
                                            >
                                        </td>
                                    </tr>
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
                                    <?php foreach($comments as $comment ): ?>
                                    <tr>
                                        <th><?=$comment['id']; ?></th>
                                        <td><?=$comment['name']; ?> </td>
                                        <td>
                                        <?=$comment['comment']; ?>
                                        </td>
                                        <td>
                                            <?php if($comment['status']==1): ?>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-dark disabled"
                                                >تایید شده</a
                                            >
                                            <?php elseif($comment['status']==0): ?>
                                            <a
                                                href="?action=edit&entity=comments&id=<?=$comment['id']?>"
                                                class="btn btn-sm btn-outline-info"
                                                >در انتظار تایید</a
                                            >
                                            <?php endif; ?>
                                            <a
                                                href="?action=delete&entity=comments&id=<?=$comment['id']?>"
                                                class="btn btn-sm btn-outline-danger"
                                                >حذف</a
                                            >
                                            
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="mt-4">
                        <h4 class="text-secondary fw-bold">دسته بندی</h4>
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
                                    <tr>
                                        <th>1</th>
                                        <td>طبیعت</td>
                                        <td>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-dark"
                                                >ویرایش</a
                                            >
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-danger"
                                                >حذف</a
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>2</th>
                                        <td>گردشگری</td>
                                        <td>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-dark"
                                                >ویرایش</a
                                            >
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-danger"
                                                >حذف</a
                                            >
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>3</th>
                                        <td>متفرقه</td>
                                        <td>
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-dark"
                                                >ویرایش</a
                                            >
                                            <a
                                                href="#"
                                                class="btn btn-sm btn-outline-danger"
                                                >حذف</a
                                            >
                                        </td>
                                    </tr>
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
            crossorigin="anonymous"
        ></script>
    </body>
</html>
