<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: ../login/login.php');
  }
session_start();
require_once(ROOT_PATH .'/Models/validate.php');
require_once(ROOT_PATH .'Controllers/Dog_userController.php');
$users = new Dog_userController();
$brog = $_POST;
login_validate_empty($brog);
$user = $users->Get_usure($brog['email']);
$login = login_validate($brog,$user);
$users->Role($login);
?>
