<?php

require_once __DIR__."/../config.php";
require_once SITE_ROOT. "/models/DB.php";
require_once SITE_ROOT. "/controllers/helpers/headers.php";

/**
 * Created by PhpStorm.
 * User: Ripper
 * Date: 11/22/2017
 * Time: 8:07 PM
 */
class RegistrationController extends DB
{
    public $db;
    public function __construct()
    {
        $this->db =  new DB();
        $this->response_header = new headers();
    }

    

    public function register($request){
        if (isset($request['name']) && isset($request['email']) && isset($request['password'])) {

            // receiving the post params
            $name = $request['name'];
            $email = $request['email'];
            $password = $request['password'];
           

            // check if user already exist
            if ($this->db->doesUserExist($email)) {
               
                $this->response["responseCode"] = "304";
                $this->response["responseMessage"] = "A User already exists with this email address " . $email;
                $this->response_header->response();
                $this->response_header->cross_origin();
                return $this->response_header->json($this->response);
            } else {
                // create a new user
                $user = $this->db->store_user($name, $email, $password);
                if ($user) {
                    // user stored successfully
                    $this->response["responseCode"] = "200";
                    $this->response["responseMessage"] = "User registered successfully";
                    $this->response["user"]["uid"] = $user["id"];
                    $this->response["user"]["name"] = $user["username"];
                    $this->response["user"]["email"] = $user["email"];
                    $this->response["user"]["created_at"] = $user["created_at"];
                    $this->response["user"]["updated_at"] = $user["updated_at"];
                    $this->response_header->response();
                    $this->response_header->cross_origin();
                    return $this->response_header->json($this->response);
                } else {
                    // user failed to store
                    $this->response["responseCode"] = "404";
                    $this->response["responseMessage"] = "Failed to register user";    
                    $this->response_header->response();
                    $this->response_header->cross_origin();
                    return $this->response_header->json($this->response);
                }
            }
        } else {
            $this->response["responseCode"] = "304";
            $this->response["responseMessage"] = "Required parameters email or password is missing!";
            $this->response_header->response();
            $this->response_header->cross_origin();
            return $this->response_header->json($this->response);
        }
    }
}