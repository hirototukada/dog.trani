<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
include '../Views/animal/include/header1.php';
$brog = $_POST;
$Questions->Insert_questions($brog);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>質問完了画面</title>
</head>
<body class="bg-light">
  <form class="h-100 mt-4 p-5">
    <div class="w-50 m-auto mt-4 border-g bg-white p-3">
      <h2 class="green-text text-center border-b pb-2">Wonderful</h2>
          <p class="g-p green-text pt-3 text-center">新規登録完了しました。</p>
          <p class="g-p green-text text-center">ご確認いただきありがとうございます。</p>
      </div>
    </form>
    <div class = "text-center"><a href="mypage.php" class="bg-white green-text green-g-under pt-1 p-2 w-25 border-g text-center w-25">マイページへ</a></div>
  </body>
</html>
