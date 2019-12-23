<?php
    session_start();
    require_once __DIR__. "/../libraries/Database.php";
    require_once __DIR__. "/../libraries/Function.php";

    $db = new Database;

    define('ROOT',$_SERVER['DOCUMENT_ROOT']."/shop-php/public/uploads/");


    $category = $db ->fetchAll("category");
    /**
     * Lay danh sach san pham moi
     */

     $sqlNew = "SELECT * FROM product WHERE 1 ORDER BY ID DESC LIMIT 3";
     $productNew = $db -> fetchsql($sqlNew);
?>