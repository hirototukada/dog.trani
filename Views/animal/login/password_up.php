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
$validation->PasswordValidationEmpty($brog);
$user = $users->Get_usure($brog['email']);
$validation->LoginValidationEmail($brog,$user);
$password = bin2hex(random_bytes(5));
$users->Update_password($password,$brog);
include '../Views/animal/include/mail.php';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>パスワード再発行完了</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/header.css">
</head>
<body class="bg-light">
  <form class="h-100 mt-4 p-5">
    <div class="w-50 m-auto mt-4 border-g bg-white p-3">
      <h2 class="green-text text-center border-b pb-2">Wonderful</h2>
          <p class="g-p green-text pt-3 text-center">パスワード再発行完了しました。</p>
          <p class="g-p green-text text-center">ご確認いただきありがとうございます。</p>
      </div>
  </form>
  <div class="text-center"><a href="login.php" class="btn green text-white w-25">ログイン画面へ</a></div>
</body>
</html>
