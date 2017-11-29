<?php

require "../../../../controllers/PhotosController.php";


$get = new PhotosController();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    echo $get->store($_REQUEST);
}else{
    echo "THIS is a POST REQUEST";
}
