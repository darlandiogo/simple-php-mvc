<?php

spl_autoload_register(function ($class_name) {    
    $file_name = __DIR__."/".$class_name . '.php';
    $file_name = str_replace("\\","/",$file_name);
    if( file_exists( $file_name ) ) {
        require ($file_name);
    }
    else {
        throw new Exception("file not found");
    }
});