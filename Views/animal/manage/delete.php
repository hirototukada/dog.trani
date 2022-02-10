<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
include '../Views/animal/include/header2.php';
var_dump($_GET['id']);
$brog = $_GET;
$Dog_post->Post_Delete($brog);
$Questions->Post_question_Delete($brog);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>投稿削除完了画面</title>
</head>
<body>
  <header><?php ?><header>
    <body class="bg-light">
      <form class="h-100 mt-4 p-5">
        <div class="w-50 m-auto mt-4 border-g bg-white p-3">
          <h2 class="green-text text-center border-b pb-2">Wonderful</h2>
              <p class="g-p green-text pt-3 text-center">削除完了しました。</p>
              <p class="g-p green-text text-center">ご確認いただきありがとうございます。</p>
          </div>
          <div class="mt-5 text-center"><a href="manage.php" class="btn green text-white w-25">マイページへ</a></div>
        </form>
  </div>
</body>
</html>
