<?php
$sql = "SELECT * FROM `categories`";
$res = $conn->query($sql);
?>
<!DOCTYPE html>
<html dir="rtl" lang="fa">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>php tutorial || blog project</title>

        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9"
            crossorigin="anonymous"
        />
        <?php //if(srt_contain($_SERVER['REQUEST_URI'],'pages')):?>
          <!-- <link rel="stylesheet" href="../../assets/css/style.css" /> -->
          <?php //else: ?>
        <link rel="stylesheet" href="./assets/css/style.css" />
        <?php //endif; ?> 

      
    </head>

    <body>
        <div class="container py-3">
            <header
                class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom"
            >
                <a
                    href="index.html"
                    class="fs-4 fw-medium link-body-emphasis text-decoration-none"
                >
                    weblog
                </a>

                <nav class="d-inline-flex mt-2 mt-md-0 me-md-auto">
                    <?php 
                    $sql = "SELECT * FROM `categories`";
                    $categories= $conn->query($sql);
                    if($categories->rowCount()>0):
                        foreach($categories as $cat): 
                    ?>

                    <a class="me-3 py-2 link-body-emphasis text-decoration-none <?=(isset($_GET['cat_id']) and $cat['id']==$_GET['cat_id'])?'fw-bold':'' ?>"
                        href="index.php?cat_id=<?= $cat['id'];?>"><?= $cat['title'];?></a>

                        <?php endforeach; ?>
                        <?php endif;?>
                </nav>
            </header>