<?php
namespace StarterPhp\Core;
//This class will be used to load the framework’s classes and functions. 
class ClassLoader
{

    // Load library classes

    public function library($lib)
    {

        include LIB_PATH . "$lib.php";
    }

    // loader helper functions. Naming conversion is xxx_helper.php;

    public function helper($helper)
    {

        include HELPER_PATH . "{$helper}_helper.php";
    }

}
