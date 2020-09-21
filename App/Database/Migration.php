<?php
// file initiliaze create structure database
namespace App\Database;

class Migration {

    protected $con;
    
    public function __construct($con = null){
		if($con !== null){
			$this->con = $con;
		}
    }
    
    public function run() {

        try {
            $this->con->exec( "

                CREATE TABLE IF NOT EXISTS clients (
                    id int AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(100) NOT NULL,
                    email VARCHAR(100),
                    phone VARCHAR(100)

                );

                CREATE TABLE IF NOT EXISTS products (
                    id int AUTO_INCREMENT PRIMARY KEY,
                    code VARCHAR(50)NOT NULL,
                    name VARCHAR(100),
                    value int,
                    description VARCHAR(255)

                );

                CREATE TABLE IF NOT EXISTS sales (
                    id int AUTO_INCREMENT PRIMARY KEY,
                    client_id int NOT NULL,
                    product_code VARCHAR(50)NOT NULL,
                    product_name VARCHAR(100),
                    value int,
                    quantity int,
                    date DATETIME NOT NULL,
                    CONSTRAINT fk_client_id FOREIGN KEY(client_id) REFERENCES clients(id)
                );


            ");
        }
        catch(\Exception $e){
            throw new \Exception('Error run migration sql');
        }

    }
}