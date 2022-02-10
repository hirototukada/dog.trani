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
$check = $users->Fetch_user();
$validation->ValidateUser($brog,$check);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>新規登録確認画面</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/header.css">
    <style>span{color: red;}</style>
</head>
  <body class="bg-light">
    <div class="align-items-center">
    <form action="sign_up.php" method="post" class="bg-white m-auto mt-5 rounded-3 border-g p-4 w-50">
      <h2 class="text-center pb-3 mb-3 border-b green-text">登録内容の確認</h2>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">ユーザー名<span>*</span></label>
      <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?=$brog['name']?>">
      <div id="nameHelp" class="form-text">
      </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">メールアドレス<span>*</span></label>
      <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?=$brog['email']?>">
    </div>
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">電話番号</label>
      <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tel" value="<?=$brog['tel']?>">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">パスワード<span>*</span></label>
      <input type="password" readonly class="form-control" id="exampleInputPassword1"  name="password" value="<?=$brog['password']?>">
    </div>
    <div class="border-t pt-3 text-center">
    <button type="button" class="btn btn-outline-secondary w-25" onclick="history.back()">戻る</button>
    <button type="submit" class="btn green text-white w-25">確認</button>
    </div>
  </form>
  </div>
    </div>
</body>
</html>
