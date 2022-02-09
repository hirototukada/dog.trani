<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
$err = $_SESSION;
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>パスワード再発行</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>span{ color: red;}</style>
    <link rel="stylesheet" type="text/css" href="/css/header.css">
</head>
<body class="bg-light">
  <div class="align-items-center">
  <form action="password_up.php" method="post" class="bg-white m-auto mt-5 rounded-2 border border-1 p-4 w-50">
    <h2 class="text-center green-text pb-3 mb-3 border-bottom">パスワード再発行</h2>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">メールアドレス<span>*</span></label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="">
    <?php if (!empty($err['msg1'])): ?>
      <div id="emailHelp" class="form-text"><span><?=$err['msg1']?></span></div>
    <?php endif; ?>
    <?php if (!empty($err['msg2'])): ?>
        <div id="emailHelp" class="form-text"><span><?=$err['msg2']?></span></div>
    <?php endif; ?>
  </div>
  <div class="border-top pt-3 text-center">
  <button type="button" class="btn btn-outline-secondary w-25" onclick="history.back()">戻る</button>
  <button type="submit" class="btn green text-white w-25">確認</button>
  </div>
</form>
</div>
</body>
</html>
