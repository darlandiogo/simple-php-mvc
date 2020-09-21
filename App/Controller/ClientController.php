<?php

 namespace App\Controller;

 use Core\Controller as Controller;
 use Core\Helpers as Helpers;
 use App\Model\Client as Client;
 

 class ClientController extends Controller{

    public function index() {
       echo 'Home Page User';
    }
    
    public function user(){
        $client  = new Client();
        $result  = $client->findAll();
        echo Helpers::convertToJson($result, JSON_PRETTY_PRINT);
        //$this->view('home.php', $result);
    }
 }

