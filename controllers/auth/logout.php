<?php 
session_start();

unset($_SESSION['user_email']);
unset($_SESSION['user_id']);
header("location:public/index.php");
exit;
?>