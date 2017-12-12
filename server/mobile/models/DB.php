<?php

/**
 * @author Kollan Hillary
 *
 */

require "Connection.php";

class DB extends Connection
{
    private $table_name;
    private $timestamp;

    function __construct() {
        // connecting to database
        $db = new Connection();
        $this->conn = $db->connect();
        $this->timestamp = date("Y-m-d H:i:s");
    }

    public function table($tablename){
        $this->table_name= $tablename;
        return $this->table_name;
    }

     /**
     * Storing new user
     * returns user details
     */

    public function store_user($name, $email, $password){
        
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
        //var_dump($uuid, $hash, $encrypted_password, $salt);die();
         $stmt = $this->conn->prepare("INSERT INTO users(id, username, password, email, salt, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("sssssss", $uuid, $name, $encrypted_password, $email, $salt, $this->timestamp, $this->timestamp);
        try{
       
        $result = $stmt->execute();
        $stmt->close();
        }catch(\Exception $e){
            return $e->getMessage();
        }
        // check for successful store
        if ($result) {
           
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $user;
        } else {
            return false;
        }
    }

    

    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");

        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check if password is equal
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return null;
        }
    }

    /**
     * Check if user exists
     */
    public function doesUserExist($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // user existed
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {

        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }

    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {

        $hash = base64_encode(sha1($password . $salt, true) . $salt);

        return $hash;
    }

    /**
     * set user online status
     * @return boolean
     */

     public function setOnlineStatus($request, $status){
        $stmt = $this->conn->prepare("UPDATE users SET online = ?  WHERE id = ? ");
        $stmt->bind_param("ss", $status, $request['user_id']);
       try{
      
       $result = $stmt->execute();
       $stmt->close();
       }catch(\Exception $e){
           return $e->getMessage();
       }
       // check for successful store
       if ($result) {
           return true;
       }
     }

}