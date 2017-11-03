<?php

namespace Core;

class View
{
    public function render($templateName, $controllerName, $params, $layout = 'default'){
        if(file_exists($_SERVER['DOCUMENT_ROOT'].'/views/'.$controllerName.'/'.$templateName.'.php')){
            $content = $_SERVER['DOCUMENT_ROOT'].'/views/'.$controllerName.'/'.$templateName.'.php';
            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/layouts/'.$layout.'/index.html')){
                include_once($_SERVER['DOCUMENT_ROOT'].'/layouts/'.$layout.'/index.html');
            }
            else{
                self::page404();
            }
        }
        else{
            self::page404();
        }
    }

    public static function page404(){
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'404');
    }
}