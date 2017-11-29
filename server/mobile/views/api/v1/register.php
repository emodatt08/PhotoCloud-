<?php
/**
 * Created by PhpStorm.
 * User: Ripper
 * Date: 11/22/2017
 * Time: 8:30 PM
 */

require "../../../controllers/RegistrationController.php";
require_once "../../../controllers/helpers/headers.php";
$cross = new Headers();
foreach($cross->cross_origin() as $key => $value){
    echo $value;
}
$send = new RegistrationController();
echo $send->register($_REQUEST);