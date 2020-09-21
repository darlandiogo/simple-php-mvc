<?php

namespace Core;

class Helpers {

    public static function convertToJson($arr, $opt = null){
        $class = $arr [0];
        $obj = new $class;
        $fields = $obj->getFields();
        $fields = explode(",",$fields);
        
        $_arr  = [];
        $_arr2 = [];

        foreach($arr as $elem){
            foreach($fields as $f){
                $_arr2[$f] = $elem->$f;
            }
            array_push($_arr, $_arr2); 
        }

        return  $opt ? json_encode($_arr, $opt): json_encode($_arr) ;
    }
}