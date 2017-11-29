<?php

class headers{

    public function response(){
        return header("Content-type:application/json");
    }
    public function cross_origin(){
   $header = [ 
       'Origin' => header('Access-Control-Allow-Origin: *'), 
       'Credentials' => header("Access-Control-Allow-Credentials: true"),
       'Methods' =>  header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS'),
       'Age' =>  header('Access-Control-Max-Age: 1000'),
       'Headers' =>   header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization')
   ];

      return $header ;       
    }

    public function json($response = []){
        
        return json_encode($response);
    }
}