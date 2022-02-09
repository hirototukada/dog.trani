<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
require_once(ROOT_PATH .'/Controllers/PlayerController.php');
$player = new PlayerController();
$get = $_GET;
$brog = $player->Fetch_question_id($get);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>質問詳細画面</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/sign.css">
</head>
<?php if ($_SESSION['role'] == 1): ?>
  <header><?php include '../Views/animal/include/header1.php';?><header>
<?php elseif ($_SESSION['role'] == 2): ?>
  <header><?php include '../Views/animal/include/header2.php';?><header>
<?php endif; ?>
<body class="bg-light">
  <div class="align-items-center">
  <form action="question_up.php" method="post" class="bg-white border-g m-auto mt-5 rounded-3 p-4 w-50">
    <h2 class="text-center pb-3 mb-3 border-b green-text">質問詳細</h2>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">ユーザー名</label>
    <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?=$brog['name']?>"readonly>
    <div id="nameHelp" class="form-text">
    </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">メールアドレス</label>
    <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?=$brog['email']?>"readonly>
  </div>
  <!-- カテゴリー -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">カテゴリー</label>
    <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=$brog['traning']?>">
    <input type="hidden" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="traning" value="<?=$brog['traning']?>">
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">質問内容</label>
  <textarea class="form-control" readonly id="exampleFormControlTextarea1" rows="5" name="body"><?=$brog['body']?></textarea>
  </div>
  <?php if ($_SESSION['role'] == 1): ?>
    <div class="border-t pt-3 text-center">
      <button type="button" class="btn btn-outline-secondary w-25"><a href = '/mypage/question_detail.php'>過去の質問一覧へ</a></button>
    </div>
  <?php elseif ($_SESSION['role'] == 2): ?>
    <div class="border-t pt-3 text-center">
      <button type="button" class="btn btn-outline-secondary w-25"><a href = 'form_past.php'>質問一覧へ</a></button>
    </div>
  <?php endif; ?>
</form>
</div>
</body>



</html>
