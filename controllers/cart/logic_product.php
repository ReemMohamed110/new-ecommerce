<?php
// echo "ok";
// die;
if (session_status() == PHP_SESSION_NONE) session_start();
include "../../helper/Sessions.php";

include "../../app/product_class.php";
$productObj = new Product;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name_en = !empty($_POST['name_en']) ? htmlspecialchars(trim($_POST['name_en'])) : null;
    $name_ar = !empty($_POST['name_ar']) ? htmlspecialchars(trim($_POST['name_ar'])) : null;
    $price = !empty($_POST['price']) ? htmlspecialchars(trim($_POST['price'])) : null;
    $code = !empty($_POST['code']) ? htmlspecialchars(trim($_POST['code'])) : null;
    $quantity = !empty($_POST['quantity']) ? htmlspecialchars(trim($_POST['quantity'])) : null;
    $status = !empty($_POST['status']) ? htmlspecialchars(trim($_POST['status'])) : null;
    $brand_id = !empty($_POST['brand_id']) ? htmlspecialchars(trim($_POST['brand_id'])) : null;
    $category_id = !empty($_POST['category_id']) ? htmlspecialchars(trim($_POST['category_id'])) : null;
    $desc_en = !empty($_POST['desc_en']) ? htmlspecialchars(trim($_POST['desc_en'])) : null;
    $desc_ar = !empty($_POST['desc_ar']) ? htmlspecialchars(trim($_POST['desc_ar'])) : null;
    $img = !empty($_FILES['image']) ? $_FILES['image']['name'] : null;
    
    
    
    // var_dump($name_en);
    // var_dump($name_ar);
    // var_dump($price);
    // var_dump($_FILES['image']);
    // die;

    //name validation
    if ($name_en == null) {
        Sessions::set("name_en", "name_en is required");
    } elseif (strlen($name_en) < 3) {
        Sessions::set("name_en", "name_en must be great than 2 char");
    } elseif (is_numeric($name_en)) {
        Sessions::set("name_en", "name_en must not be numeric");
    }

    //name validation
    if ($name_ar == null) {
        Sessions::set("name_ar", "name_ar is required");
    } elseif (strlen($name_ar) < 3) {
        Sessions::set("name_ar", "name_ar must be great than 2 char");
    } elseif (is_numeric($name_ar)) {
        Sessions::set("name_ar", "name_ar must not be numeric");
    }


    //price validation
    if ($price == null) {
        Sessions::set("price", "price is required");
    } elseif (!is_numeric($price)) {
        Sessions::set("price", "price must not be numeric");
    }
    //code validation
    if ($code == null) {
        Sessions::set("code", "code is required");
    } elseif (!is_numeric($code)) {
        Sessions::set("code", "code must be numeric");
    }

    if ($quantity == null) {
        Sessions::set("quantity", "quantity is required");
    } elseif (!is_numeric($code)) {
        Sessions::set("quantity", "quantity must be numeric");
    }
    if ($brand_id == null) {
        Sessions::set("brand_id", "brand is required");
    }
    if ($category_id == null) {
        Sessions::set("subcategory_id", "subcategory is required");
    }
    if ($desc_en == null) {
        Sessions::set("desc_en", "desc_en is required");
    }
    if ($desc_ar == null) {
        Sessions::set("desc_ar", "desc_ar is required");
    }
    if ($img == null) {
        Sessions::set("image", "image is required");
    }



    
    if (Sessions::has('code') == "true" || Sessions::has('name_en') == "true" || Sessions::has('name_ar') == "true" || Sessions::has('price') == "true" || Sessions::has('quantity') == "true" || Sessions::has('status') == "true" || Sessions::has('brand_id') == "true" || Sessions::has('category_id') == "true" || Sessions::has('desc_ar') == "true" || Sessions::has('desc_en') == "true" || Sessions::has('image') == "true") {
        
        Sessions::set("fail", "failed to add product");
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
        
    } else {
        $image_path = "../../public/assets/img/product/".$img;
            move_uploaded_file($_FILES['image']["tmp_name"], $image_path);
            $image="../public/assets/img/product/".$img;
        if(isset($_GET['id'])){
            Sessions::set("success", "product edited successfully");
        
        $productObj->editProduct($_GET['id'],$name_en, $name_ar, $price, $quantity, $desc_en, $desc_ar, $image, $code, $status, $brand_id, $category_id);
        
        header("location:../../AdminLTE-3.1.0/allProducts.php");
        
        exit;
        }
        Sessions::set("success", "product added successfully");
        
        $productObj->addProduct($name_en, $name_ar, $price, $quantity, $desc_en, $desc_ar, $image, $code, $status, $brand_id, $category_id);
        
        header("location:" . $_SERVER['HTTP_REFERER']);
        
        exit;
        
    }
}
