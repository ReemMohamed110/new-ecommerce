<?php

if (session_status() == PHP_SESSION_NONE) session_start();
include_once "inc/header.php";
include_once __DIR__ . "/inc/nav.php";
include_once "../app/review_class.php";
$showReviews = new Reviews();
?>
<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">Reviews</h3>
        <div class="card-tools">
            <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-download"></i>
            </a>
            <a href="#" class="btn btn-tool btn-sm">
                <i class="fas fa-bars"></i>
            </a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-striped table-valign-middle">
            <thead>
                <tr>
                    <th>user_id</th>
                    <th>user name</th>
                    <th>review</th>
                    <th>product_id</th>
                    <th>product name</th>

                </tr>
            </thead>




            <?php

            $res = $showReviews->allReviews();
            foreach ($res as  $value) { ?>
                <tr><?php
                    $id=$value['user_id'];
                    $q = "SELECT users.name FROM users JOIN reviews on reviews.user_id=users.id WHERE  user_id= $id  ";
                    $sql = new PDO("mysql:host=localhost;dbname=newEcommerce", "root", "");
                    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn = $sql->prepare($q);
                    $conn->execute();
                    $users = $conn->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($users as $user) {
                    } ?>
                    <?php
                    $product_id=$value['product_id'];
                    $q = "SELECT products.name_en FROM products JOIN reviews on reviews.product_id=products.id WHERE  product_id= $product_id  ";
                    $sql = new PDO("mysql:host=localhost;dbname=newEcommerce", "root", "");
                    $sql->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $conn = $sql->prepare($q);
                    $conn->execute();
                    $products = $conn->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($products as $product) {
                    } ?>
                    <td><?= $value['user_id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $value['comments'] ?></td>
                    <td><?= $value['product_id'] ?></td>
                    <td><?= $product['name_en'] ?></td>
                    <td><?= $value['created_at'] ?></td>
                </tr>

            <?php }

            ?>



        </table>
    </div>
</div>


<!-- ../public/assets/img/product/plumber.jpeg -->
<?php
include_once "inc/footer.php";
?>