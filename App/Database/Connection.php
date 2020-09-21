<?php

namespace App\Database;

class Connection {

    protected $dsn =  '';
    protected $user = '';  
    protected $password = ''; 
    protected static $conn = null;

    public function __construct($env)
    {
        $this->dsn = $env["DB_CONNECTION"].':dbname='.$env["DB_NAME"].';host='.$env["HOST"].';port='.$env["PORT"];
        $this->user = $env["USER"];
        $this->password = $env["PASSWORD"];
    }

    public function getConnection()
    {
        if(self::$conn){
            return self::$conn;
        }
        return $this->createConnection();
    }

    private function createConnection()
    {
        try {
            self::$conn = new \PDO($this->dsn, $this->user, $this->password);
            return self::$conn;
        } catch (\PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    } 

    protected function __clone() { 

    }

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

}