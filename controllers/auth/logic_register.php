<?php
if (session_status() == PHP_SESSION_NONE) session_start();
include "../helper/Sessions.php";

include "app/user_class.php";
$userObj = new User;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = !empty($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : null;
    $email = !empty($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : null;
    $phone = !empty($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : null;
    $password = !empty($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : null;
    $confirm_password = !empty($_POST['confirm_password']) ? htmlspecialchars(trim($_POST['confirm_password'])) : null;
    $gender = !empty($_POST['gender']) ? htmlspecialchars(trim($_POST['gender'])) : null;
    $role = !empty($_POST['role']) ? htmlspecialchars(trim($_POST['role'])) : null;

    //name validation
    if (empty($name)) {
        Sessions::set("name", "name is required");
    } elseif (strlen($name) < 3) {
        Sessions::set("name", "name must be great than 2 char");
    } elseif (is_numeric($name)) {
        Sessions::set("name", "name must not be numeric");
    }
    //email validation
    if (empty($email)) {
        Sessions::set("email", "email is required");
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Sessions::set("email", "invalid email format");
        }
    }
    //phone validation
    if (empty($phone)) {
        Sessions::set("phone", "phone is required");
    } else {
        if (!is_numeric($phone)) {
            Sessions::set("phone", "invalid phone number");
        }
    }
    //password validation
    if (empty($password)) {
        Sessions::set("password", "password is required");
    } else {
        if (strlen($password) < 2 || strlen($password) > 20) {
            Sessions::set("password", "invalid password");
        }
    }

    if (empty($confirm_password)) {
        Sessions::set("confirm_password", "confirm password is required");
    } else {
        if ($confirm_password !== $password) {
            Sessions::set("confirm_password", "confirm password not confirmed");
        }
    }
    if (empty($gender)) {
        Sessions::set("gender", "gender is required");
    }
    if (empty($role)) {
        Sessions::set("role", "role is required");
    }

    if (!Sessions::has('email') == "true" && !Sessions::has('password') == "true" && !Sessions::has('name') == "true" && !Sessions::has('confirm_password') == "true" && !Sessions::has('gender') == "true" && !Sessions::has('role') == "true") {


        $userObj->create($name, $email, $phone, $password, $gender, $role);
        header("location:public/index.php?page=home");
        exit;
    } else {
        Sessions::set("fail", "failed to register");
        header("location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
