<?php
session_start();
$err = $_SESSION;
$_SESSION = array();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>ログイン画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
    <div class="top">
      <h1>「私たちに合う」が、<br>きっとみつかる</h1>
    </div>
    </div>
    <div class="login">
      <form action="../login/role.php" method="POST">
        <div class="body">
          <div class="mail mb-3">
            <label>メールアドレス:</label>
          </div>
          <div class="input mb-3">
            <input type="text" class="col-12" name="email" value="">
              <?php if (!empty($err['msg1'])): ?>
                <span><?=$err['msg1']?></span>
              <?php endif; ?>
          </div>
        </div>
        <div class="body">
          <div class="mail">
            <label>パスワード:</label>
          </div>
          <div class="input">
            <input type="password" class="col-12" name="password" value="">
              <?php if (!empty($err['msg2'])): ?>
                <span><?=$err['msg2']?></span>
              <?php endif; ?>
          </div>
        </div>
        <div class="log mt-3">
          <input type="submit" class="button btn-primary" name="submit" value="ログイン">
        </div>
      </form>
        <div class="link mb-2 mt-4">
          <a href="sign.php">新規登録はこちらから</a>
        </div>
        <div class="link mb-4">
          <a href="password.php">パスワード忘れた方はこちらから</a>
        </div>
    </div>
</body>
</html>
