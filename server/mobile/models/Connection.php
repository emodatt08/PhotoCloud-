<?php

/**
 * Created by PhpStorm.
 * User: Ripper
 * Date: 11/22/2017
 * Time: 6:26 AM
 */
class Connection
{
    public $conn;
    /**
     * Database config variables
     */
    const HOST = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const DATABASE = "Pixily";

    /**
     * Database connection method
     * @return mixed
     */
    public function connect(){
        // Connecting to mysql database
        $this->conn = new mysqli(self::HOST, self::USER, self::PASSWORD, self::DATABASE);
            return $this->conn;
    }

}