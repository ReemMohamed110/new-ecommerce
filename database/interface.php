<?php

interface userInterface
{
    function create($name, $email, $phone, $password, $gender, $role);
    function login($email, $password);
    function forgetPassword();
}
interface productInterface
{
    function addProduct($name_en, $name_ar, $price, $quantity, $desc_en, $desc_ar, $image, $code, $status, $brand_id, $category_id);
    function showProducts();
    function showEditProduct($id);
    function editProduct($id, $name_en, $name_ar, $price, $quantity, $desc_en, $desc_ar, $image, $code, $status, $brand_id, $category_id);
    function deleteProduct($id);
}
interface cartInterface
{
    function create($user_id, $product_id, $quantity);
    function read($user_id);
    function update($user_id, $product_id, $quantity);
    function delete($user_id, $product_id);
}
interface brandInterface
{
    function addBrand($name_en, $name_ar, $image, $status);
    function showBrands();
    function showEditBrand($id);
    function editBrand($id, $name_en, $name_ar, $image, $status);
    function deleteBrand($id);
}
interface categoryInterface
{
    function addCategory($name_en, $name_ar, $image, $status);
    function showCategory();
    function showEditCategory($id);
    function editCategory($id, $name_en, $name_ar, $image, $status);
    function deleteCategory($id);
}
interface BlogInterface
{
    function create();
    function read();
    function update($id);
    function delete($id);
}

interface reviewInterface
{
    function addReview($comment, $user_id, $product_id);
    // function read();
    // function update();
    // function delete();
}
