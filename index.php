<?php

use App\Database\Connection as Connection ;
use App\Database\Migration as Migration;
use Core\Model as Model;
use Core\Router as Router;

require __DIR__. '/autoload.php';

try {

    $env  = parse_ini_file(".env");
    $db   = new Connection($env);

    $migration = new Migration($db->getConnection());
    $migration->run();

    Model::initialize($db->getConnection()); 
  
    Router::handle($_SERVER['REQUEST_URI']);

    require __DIR__. '/App/router.php';

} catch ( Exception $e) {
    echo "line: ".$e->getLine(). ", file: ".$e->getFile() .", error: ". $e->getMessage();
}