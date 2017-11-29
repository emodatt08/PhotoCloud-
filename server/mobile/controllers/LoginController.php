<?php
require_once __DIR__."/../config.php";
require_once SITE_ROOT. "/models/DB.php";
require_once SITE_ROOT. "/controllers/helpers/headers.php";




/**
 * Created by PhpStorm.
 * User: Ripper
 * Date: 11/22/2017
 * Time: 8:24 PM
 */
class LoginController extends DB
{
    public $db;
    public $response = ["error" => false];

    public function __construct()
    {
        $this->db =  new DB();
        $this->response_header = new headers();
    }

    public function login($request){
        // json response array
        $this->response = [];

        if (isset($request['email']) && isset($request['password'])) {
            // receiving the post params
            $email = $request['email'];
            $password = $request['password'];

            // get the user by email and password
            $user =  $this->db->getUserByEmailAndPassword($email, $password);
           
            if ($user != false) {
                // user exists
                $this->response["responseCode"] = "200";
                $this->response["responseMessage"] = "User verified successfully";
                $this->response["uid"] = $user["id"];
                $this->response["user"]["name"] = $user["username"];
                $this->response["user"]["email"] = $user["email"];
                $this->response["user"]["created_at"] = $user["created_at"];
                $this->response["user"]["updated_at"] = $user["updated_at"];
                $this->response_header->response();
                $this->response_header->cross_origin();
                return $this->response_header->json($this->response);
            } else {
                // user with these credentials doesnt exists
                $this->response["responseCode"] = "404";
                $this->response["responseMessage"] = "Login credentials are wrong. Please try again!";                
                $this->response_header->response();
                $this->response_header->cross_origin();
                return $this->response_header->json($this->response);
            }
        } else {
            // required post params is missing
            $this->response["responseCode"] = "304";
            $this->response["responseMessage"] = "Required parameters email or password is missing!";
            $this->response_header->response();
            $this->response_header->cross_origin();
            return $this->response_header->json($this->response);
        }
    }

}