<?php

use Core\Router as Router;


Router::get('/', 'ClientController@index');
Router::get('/user', 'ClientController@user');
