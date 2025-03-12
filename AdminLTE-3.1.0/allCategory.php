<?php

if (session_status() == PHP_SESSION_NONE) session_start();
include_once "inc/header.php";
include_once __DIR__ . "/inc/nav.php";
include_once "../app/category_class.php";
$showCategory = new Category();
?>
<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title">categories</h3>
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
                    <th>name</th>
                    <th>image</th>
                    <th>action</th>
                </tr>
            </thead>
           
            <?php

            $res = $showCategory->showCategory();
            foreach ($res as  $value) { 
                ?>
            
                <tr>
                    <td><?= $value['name_en'] ?></td>
                    <td><img width="100" height="100" src='<?=$value['image'] ?>'></td>
                    <td>
                        <a href="../controllers/cart/logic_delete.php?id=<?php echo $value['id'] ?>&tittle=category" class="btn btn-danger" style="font-size: 18px; padding: 10px 20px;"><i class="fas fa-trash"></i></i> </a>
                        <a href="editCategory.php?id=<?php echo $value['id'] ?>" class="btn btn-info" style="font-size: 18px; padding: 10px 20px;"><i class="fas fa-edit"></i> </a>

                    </td>
                </tr>
                
                    <?php }

                    ?>

                    

        </table>
    </div>
</div>



<?php
include_once "inc/footer.php";
?>