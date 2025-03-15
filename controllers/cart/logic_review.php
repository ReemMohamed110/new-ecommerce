<?php
if (session_status() == PHP_SESSION_NONE) session_start();
include "helper/Sessions.php";

include "app/review_class.php";
$reviewObj=new Reviews;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $product_id=$_GET['product'];
    $user_id=$_SESSION['user_id'];
    $comments = !empty($_POST['comments']) ? htmlspecialchars(trim($_POST['comments'])) : null;
    $name = !empty($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;
    
// var_dump($comments);
//         var_dump($user_id);
//         var_dump($product_id);
//         die;

    // var_dump($name_en);
    // var_dump($name_ar);
    // var_dump($price);
    // var_dump($code);
    // die;

    //name validation
    if ($comments == null) {
        Sessions::set("comments", "review is required");
    } elseif (strlen($comments) < 1) {
        Sessions::set("comments", "review must be great than 1 char");
    } elseif (is_numeric($comments)) {
        Sessions::set("comments", "review must not be numeric");
    }

    


    if ( Sessions::has('comments') == "true"  ) {

        Sessions::set("fail", "can't make comments");
        Sessions::set("success", "review added successfully");
        
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        
        
         
        Sessions::set("success", "review added successfully");
        // var_dump($comments);
        // var_dump($user_id);
        // var_dump($product_id);
        // die;
        $reviewObj->addReview($comments,$product_id,$user_id);

        header("location:" . $_SERVER['HTTP_REFERER']);

        exit;
    }
}
