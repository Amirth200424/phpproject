<?php
$cdn = "mysql:host=localhost;dbname=blog;charset=utf8";
$user = "root";
$pass = "";
try {
    $conn = new PDO($cdn, $user, $pass);
} catch (PDOException $e) {
    echo $e->getMessage();
}
