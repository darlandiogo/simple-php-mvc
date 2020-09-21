<?php

namespace Core;

class Router {

    protected static $request_uri;

    public static function handle($request_uri){
        self::$request_uri = $request_uri;
    }

    public static function get ($path, $context){
        if($path === self::$request_uri){
            $context    = explode("@",$context);
            $class      = "App\Controller\\".$context[0];
            $method     = $context[1];
            $controller = new $class;
            $controller->$method();
        }
    }
}