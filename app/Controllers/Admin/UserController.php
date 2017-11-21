<?php

namespace App\Controllers\Admin;
use StarterPhp\Core\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{

    public function mainAction()
    {

        include CURR_VIEW_PATH . "main.html";

        // Load Captcha class

        $this->loader->library("Captcha");

        $captcha = new Captcha;

        $captcha->hello();

        $userModel = new UserModel("user");

        $users = $userModel->getUsers();
    }

    public function indexAction()
    {
        $userModel = new UserModel("user");
        $users = $userModel->getUsers();
        echo "<pre>";
        var_dump($users);
        exit;
        // Load View template
        include CURR_VIEW_PATH . "index.html";
    }

}
