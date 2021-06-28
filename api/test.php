<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname (_FILE_)."dao/UserDao.class.php";

$user_dao=new UserDao():

$user=$user_dao->get_user_by_email("mela.sacic@gmail.com");

//print_r($user);
echo json_encode($user);
 ?>
