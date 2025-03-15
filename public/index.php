<?php 

session_start();
 use Database\MigrationManager;
use DatabaseManager\DatabaseManager;
 require_once '../inc/header.php';
 
//  require_once '../inc/nav.php';
require '../database/DatabaseManager.php';
require '../database/MigrationManager.php';


DatabaseManager::initialize();
MigrationManager::runMigrations();
 require_once '../routes/web.php';













 
require_once '../inc/footer.php';

?>