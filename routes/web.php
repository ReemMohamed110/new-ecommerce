<?php
$page = isset($_GET['page']) ? $_GET['page'] : "home";
// var_dump($page);
// die;
switch ($page) {
    case 'home':
        include "../public/index-2.php";
        break;
    case 'checkout':
        include "../view/cart/checkout.php";
        break;
    case 'product-details':
        include "../view/product-details.php";
        break;
    case 'about':
        include "../view/about.php";
        break;
    case 'contact':
        include "../view/auth/contact.php";
        break;
    case 'privacy-policy':
        include "../view/privacy-policy.php";
        break;
    case 'faq':
        include "../view/faq.php";
        break;

    case 'login':
        include "../view/auth/login.php";
        break;
    case 'register':
        include "../view/auth/register.php";
        break;
    case 'forget-password':
        include "../view/auth/forget-password.php";
        break;
    case '404':
        include "../view/error/404.php";
        break;
    case 'cart':
        include "../view/cart/cart.php";
        break;
    case 'tracking':
        include "../view/tracking.php";
        break;
    case 'blog':
        include "../view/blog/blog.php";
        break;
    case 'blog-details':
        include "../view/blog/blog-details.php";
        break;
    case 'my-account':
        include "../view/auth/my-account.php";
        break;
    case 'all_product':
        include "../view/cart/all_product.php";
        break;
    // case 'logic_contact':
    //     include "../controllers/auth/logic_contact.php";
    //     break;
    case 'logic_register':
        include "../controllers/auth/logic_register.php";
        break;
    case 'admin':
        include "../admin.php";
        break;

    default:
        include "../view/error/404.php";
        break;
}
