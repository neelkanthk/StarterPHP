<?php

namespace StarterPhp\Core;

use StarterPhp\Core\ClassLoader;

class BaseController
{

    // Base Controller has a property called $loader, it is an instance of Loader class

    protected $loader;

    public function __construct()
    {

        $this->loader = new ClassLoader();
    }

    public function redirect($url, $message, $wait = 0)
    {

        if ($wait == 0) {

            header("Location:$url");
        } else {

            include CURR_VIEW_PATH . "message.html";
        }


        exit;
    }

}
