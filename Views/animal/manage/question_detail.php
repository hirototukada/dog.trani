<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
if ($_SESSION['role'] == 1){
  include '../Views/animal/include/header1.php';
}elseif ($_SESSION['role'] == 2){
  include '../Views/animal/include/header2.php';
}
$get = $_GET;
$brog = $Questions->Fetch_question_id($get);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>質問詳細画面</title>
</head>
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
