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
                    <th>comment</th>
                    <th>product_id</th>
                </tr>
            </thead>
           
            <?php

            $res = $showReviews->allReviews();
            foreach ($res as  $value) { ?>
                <tr>
                    <td><?= $value['user_id'] ?></td>
                    <td><?= $value['comments']?></td>
                    <td><?= $value['product_id'] ?></td>
                    <!-- <td>
                        <a href="../controllers/cart/logic_delete.php?id=
                        <?php 
                        // echo $value['id']
                         ?>
                        &tittle=brand" class="btn btn-danger" style="font-size: 18px; padding: 10px 20px;"><i class="fas fa-trash"></i></i> </a>
                        <a href="editBrand.php?id=
                        <?php 
                        // echo $value['id'] 
                        ?>" class="btn btn-info" style="font-size: 18px; padding: 10px 20px;"><i class="fas fa-edit"></i> </a>

                    </td> -->
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