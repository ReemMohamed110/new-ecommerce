<?php
use DatabaseManager\DatabaseManager;
include_once __DIR__ . '\..\config\database.php';
include_once __DIR__ . '\..\database\interface.php';
include_once __DIR__ . '\..\database\DatabaseManager.php';


class Blog implements BlogInterface
{
    private $db;
    public $title;
    public $content ;
    public $image ;

    public function __construct()
    {
        $this->db = DatabaseManager::getConnection();
    }

    private function BlogValidation($title , $content , $image)
    {
        
    }

    function create()
    {


    }
    function read()
    {

    }
    function update()
    {

    }
    function delete()
    {
        
    }






}














?>