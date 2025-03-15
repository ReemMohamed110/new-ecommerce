<?php

$page = isset($_GET['page']) ? $_GET['page'] : "home";
// var_dump($page);
// die;
switch ($page) {

    case 'admin':

        include "public/indexAdmin.php";
        break;
    case 'logic_contact':
        include "controllers/auth/logic_contact.php";
        break;
    case 'logic_login':
        include "controllers/auth/logic_login.php";
        break;
    case 'logic_register':
        include "controllers/auth/logic_register.php";
        break;
    case 'logic_review':
        include "controllers/cart/logic_review.php";
        break;
    case 'logic_login_check':

        include "controllers/auth/logic_login.php";
        break;
    case 'logout':
        include "controllers/auth/logout.php";
        break;

    default:
        include "../view/error/404.php";
        break;
}
