<?php
// echo "ok";
// die;
if (session_status() == PHP_SESSION_NONE) session_start();
include "../../helper/Sessions.php";

include "../../app/brand_class.php";
$brandObj = new Brand;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name_en = !empty($_POST['name_en']) ? htmlspecialchars(trim($_POST['name_en'])) : null;
    $name_ar = !empty($_POST['name_ar']) ? htmlspecialchars(trim($_POST['name_ar'])) : null;
    $status = !empty($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : null;
    $img = !empty($_FILES['image']) ? $_FILES['image']['name'] : null;



    // var_dump($name_en);
    // var_dump($name_ar);
    // var_dump($price);
    // var_dump($code);
    // die;

    //name validation
    if ($name_en == null) {
        Sessions::set("name_en", "name_en is required");
    } elseif (strlen($name_en) < 1) {
        Sessions::set("name_en", "name_en must be great than 1 char");
    } elseif (is_numeric($name_en)) {
        Sessions::set("name_en", "name_en must not be numeric");
    }

    //name validation
    if ($name_ar == null) {
        Sessions::set("name_ar", "name_ar is required");
    } elseif (strlen($name_ar) < 2) {
        Sessions::set("name_ar", "name_ar must be great than 2 char");
    } elseif (is_numeric($name_ar)) {
        Sessions::set("name_ar", "name_ar must not be numeric");
    }



    if ($status == null) {
        Sessions::set("status", "status is required");
    }




    if (Sessions::has('name_en') == "true" || Sessions::has('name_ar') == "true"  || Sessions::has('status') == "true") {

        Sessions::set("fail", "failed to add brand");
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        if ($img != null) {
            $image_path = "../../public/assets/img/product/".$img;
            move_uploaded_file($_FILES['image']["tmp_name"], $image_path);
            $image="../public/assets/img/product/".$img;
            
        }
        if (isset($_GET['id'])) {
            Sessions::set("success", "brand updated successfully");

            $brandObj->editBrand($_GET['id'], $name_en, $name_ar, $image, $status);

            header("location:../../AdminLTE-3.1.0/allBrands.php");

            exit;
        }
        Sessions::set("success", "brand added successfully");

        $brandObj->addBrand($name_en, $name_ar, $image, $status);

        header("location:" . $_SERVER['HTTP_REFERER']);

        exit;
    }
}
