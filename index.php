<?php


    require_once($_SERVER['DOCUMENT_ROOT']."/Autoloader.class.php");

    Autoloader::register();


    if(empty($_GET['c']) && empty($_GET['act'])){

        $b = new C_Main();
        $b->View();

    } else {

         $class='C_'.$_GET['c'];
         $object= new $class();

         $method=$_GET['act'];
         $object->$method();
    }



?>


