<?php

namespace Core;

use Core\View;

/**
 * Class for run system
 */
class Route {

    /**
     * @var Singleton The reference to *Singleton* instance of this class
     */
    protected static $_instance;

    /**
     * Protected constructor to prevent creating a new instance of the
     * *Singleton* via the `new` operator from outside of this class.
     */
    protected function __construct() {
        spl_autoload_extensions('.php');
        spl_autoload_register();
    }

    /**
     * Private clone method to prevent cloning of the instance of the
     * *Singleton* instance.
     *
     * @return void
     */
    private function __clone(){}

    /**
     * Private unserialize method to prevent unserializing of the *Singleton*
     * instance.
     *
     * @return void
     */
    private function __wakeup(){}

    /**
     * Returns the *Singleton* instance of this class.
     *
     * @return Singleton The *Singleton* instance.
     */
    public static function init() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function run(){
        $actionName = 'Index';
        $controllerName = 'Index';
        if(!empty($_SERVER['argv'])){
            if(strpos($_SERVER['argv'][0], '/') !== false){
                $str = explode('/', $_SERVER['argv'][0]);
                $controllerName = ucfirst($str[0]);
                if(!empty($str[1])){
                    $actionName = ucfirst($str[1]);
                }
            }
        }
        $controllerName = '\\controllers\\'.$controllerName;
        $actionName = 'action'.$actionName;

        $controller = new $controllerName;
        if(method_exists($controller, $actionName)) {
            $controller->$actionName();
        }
        else{
            View::page404();
        }

        self::$_instance = $this;

        return self::$_instance;
    }
}