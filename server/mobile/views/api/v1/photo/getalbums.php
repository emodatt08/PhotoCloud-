<?php
require "../../../../controllers/PhotosController.php";
require_once "../../../../controllers/helpers/headers.php";
$cross = new Headers();
foreach($cross->cross_origin() as $key => $value){
    echo $value;
}
$get = new PhotosController();
echo $get->albums_all($_REQUEST);