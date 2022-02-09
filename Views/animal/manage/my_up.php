<?php
session_start();
require_once(ROOT_PATH .'/Controllers/PlayerController.php');
$player = new PlayerController();
$brog = $_POST;
$player->UP_date_Post($brog);
?>
<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>更新完了</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/sign.css">
</head>
<body>
  <header><?php include '../Views/animal/include/header2.php';?><header>
  <body class="bg-light">
  <form class="h-100 mt-4 p-5">
    <div class="w-50 m-auto mt-4 border-g bg-white p-3">
      <h2 class="green-text text-center border-b pb-2">Wonderful</h2>
          <p class="g-p green-text pt-3 text-center">更新完了しました。</p>
          <p class="g-p green-text text-center">ご確認いただきありがとうございます。</p>
      </div>
  </form>
  <div class="text-center"><a href="manage.php" class="btn green text-white w-25">マイページへ</a></div>
</body>
</html>
