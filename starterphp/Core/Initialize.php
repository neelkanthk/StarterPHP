<?php

namespace StarterPhp\Core;

class Initialize
{

    public static function bootstrap()
    {
        self::init();

        self::autoload();

        self::dispatch();
    }

    // Initialization
    private static function init()
    {

        // Start session
        session_start();

        // Define path constants

        define("DS", DIRECTORY_SEPARATOR);

        define("ROOT", getcwd() . DS);

        define("APP_PATH", ROOT . 'app' . DS);

        define("FRAMEWORK_PATH", ROOT . "starterphp" . DS);

        define("PUBLIC_PATH", ROOT . "public" . DS);


        define("CONFIG_PATH", APP_PATH . "Config" . DS);

        define("CONTROLLER_PATH", APP_PATH . "Controllers" . DS);

        define("MODEL_PATH", APP_PATH . "Models" . DS);

        define("VIEW_PATH", APP_PATH . "Views" . DS);


        define("CORE_PATH", FRAMEWORK_PATH . "Core" . DS);

        define('DB_PATH', FRAMEWORK_PATH . "Database" . DS);

        define("LIB_PATH", FRAMEWORK_PATH . "Libraries" . DS);

        define("HELPER_PATH", FRAMEWORK_PATH . "Helpers" . DS);

        // Load configuration file
        $GLOBALS['config'] = include CONFIG_PATH . "appconfig.php";
        // Define platform, controller, action, for example:
        // index.php?p=admin&c=Goods&a=add

        define("PLATFORM", isset($_REQUEST['p']) ? $_REQUEST['p'] : $GLOBALS['config']['default_platform']);

        define("CONTROLLER", isset($_REQUEST['c']) ? $_REQUEST['c'] : $GLOBALS['config']['default_controller']);

        define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : $GLOBALS['config']['default_action']);


        define("CURR_CONTROLLER_PATH", CONTROLLER_PATH . PLATFORM . DS);

        define("CURR_VIEW_PATH", VIEW_PATH . PLATFORM . DS);


        // Load core classes

        require CORE_PATH . "BaseController.php";

        require CORE_PATH . "ClassLoader.php";

        require DB_PATH . "Mysql.php";

        require CORE_PATH . "BaseModel.php";
    }

    // Autoloading
    private static function autoload()
    {
        spl_autoload_register(array(__CLASS__, 'load'));
    }

    // Define a custom load method

    private static function load($classname)
    {
        // Here simply autoload app’s controller and model classes

        if (substr($classname, -10) == "Controller") {
            // Controller
            require_once CURR_CONTROLLER_PATH . "$classname.php";
        } elseif (substr($classname, -5) == "Model") {

            // Model
            require_once MODEL_PATH . "$classname.php";
        }
    }

    // Routing and dispatching

    private static function dispatch()
    {
        //In this step, index.php will dispatch the request to the proper Controller::Action() method
        // Instantiate the controller class and call its action method

        $controller_name = "App\\Controllers\\" . PLATFORM . "\\" . CONTROLLER . "Controller";
        
        $action_name = ACTION . "Action";

        $controller = new $controller_name;

        $controller->$action_name();
    }

}
