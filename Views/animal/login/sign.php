<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
require_once(ROOT_PATH .'/Models/validate.php');
$err = $_SESSION;
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>新規登録画面</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>span{color: red;}</style>
    <link rel="stylesheet" type="text/css" href="/css/header.css">
</head>
<body class="bg-light">
  <div class="align-items-center">
  <form action="sign_check.php" method="post" class="bg-white border-g m-auto mt-5 rounded-3 p-4 w-50">
    <h2 class="text-center pb-3 mb-3 border-b green-text">新規登録</h2>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">ユーザー名<span>*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="">
    <div id="nameHelp" class="form-text">
        <?php if (!empty($err['name'])): ?>
          <div id="emailHelp" class="form-text"><span><?=$err['name']?></span></div>
        <?php endif; ?>
    </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">メールアドレス<span>*</span></label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="">
    <?php if (!empty($err['email'])): ?>
      <div id="emailHelp" class="form-text"><span><?=$err['email']?></span></div>
    <?php elseif (!empty($err['email1'])): ?>
      <div id="emailHelp" class="form-text"><span><?=$err['email1']?></span></div>
    <?php endif; ?>
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">電話番号</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="tel" value="">
    <?php if (!empty($err['tel'])): ?>
      <div id="emailHelp" class="form-text"><span><?=$err['tel']?></span></div>
    <?php endif; ?>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">パスワード<span>*</span></label>
    <input type="password" class="form-control" id="exampleInputPassword1"  name="password" value="">
    <?php if (!empty($err['password'])): ?>
      <div id="emailHelp" class="form-text"><span><?=$err['password']?></span></div>
    <?php endif; ?>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">パスワード確認<span>*</span></label>
    <input type="password" class="form-control" id="exampleInputPassword1"  name="password_conf" value="">
    <?php if (!empty($err['password1'])): ?>
      <div id="emailHelp" class="form-text"><span><?=$err['password1']?></span></div>
    <?php endif; ?>
  </div>
  <div class="border-t pt-3 text-center">
  <button type="button" class="btn btn-outline-secondary w-25" onclick="history.back()">戻る</button>
  <button type="submit" class="btn green text-white w-25">確認</button>
  </div>
</form>
</div>
</body>
</html>
