<?php

namespace Core;

use Core\View as View;

class Controller {
    protected $view;
    public function __construct(){
        $this->view = new View();
    }

    public function view($name, $arguments){
        $this->view->render($name, $arguments);  
    }

}