<?php
/**
 * Created by PhpStorm.
 * User: Ripper
 * Date: 11/22/2017
 * Time: 8:30 PM
 */

require "../../../controllers/LoginController.php";
require_once "../../../controllers/helpers/headers.php";
$send = new LoginController();
$cross = new Headers();
foreach($cross->cross_origin() as $key => $value){
    echo $value;
}
echo $send->login($_REQUEST);