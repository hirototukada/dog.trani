<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: ../login/login.php');
  }
session_start();
require_once(ROOT_PATH .'Controllers/ValidateController.php');
$validation = new ValidateController();
require_once(ROOT_PATH .'Controllers/Dog_userController.php');
$users = new Dog_userController();
$brog = $_POST;
$validation->LoginValidationEmpty($brog);
$user = $users->Get_usure($brog['email']);
$login = $validation->LoginValidation($brog,$user);
$users->Role($user);
?>
