<?php

namespace Core;

class View {
    
    protected $path = __DIR__.'/../App/Views';

    public function render($view, $params){
        if( file_exists( $this->path .'/'. $view )){
            foreach($params as $key => $value){
                $$key = $value;
            }
            require $this->path .'/'.$view;
        }
        else {
            require $this->path .'/error.php';
        }
    }
}