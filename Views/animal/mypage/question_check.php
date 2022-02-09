<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
require_once(ROOT_PATH .'/Controllers/PlayerController.php');
require_once(ROOT_PATH .'/Models/validate.php');
$player = new PlayerController();
$brog = $_POST;
question_validate($brog);
$traning = $player->get_traning($brog['traning']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>質問確認画面</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/sign.css">
</head>
<header><?php include '../Views/animal/include/header1.php';?><header>
<body class="bg-light">
  <div class="align-items-center">
  <form action="question_up.php" method="post" class="bg-white border-g m-auto mt-5 rounded-3 p-4 w-50">
    <h2 class="text-center pb-3 mb-3 border-b green-text">プロに質問</h2>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">ユーザー名<span>*</span></label>
    <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?=$brog['name']?>"readonly>
    <input type="hidden" name = "id" value = "<?=$_SESSION['id']?>">
    <div id="nameHelp" class="form-text">
    </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">メールアドレス<span>*</span></label>
    <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?=$brog['email']?>"readonly>
  </div>
  <!-- カテゴリー -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">カテゴリー<span>*</span></label>
    <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?=$traning['name']?>">
    <input type="hidden" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="traning" value="<?=$brog['traning']?>">
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">質問内容</label>
  <textarea class="form-control" readonly id="exampleFormControlTextarea1" rows="5" name="body"><?=$brog['body']?></textarea>
  </div>
  <div class="border-t pt-3 text-center">
    <button type="button" class="btn btn-outline-secondary w-25" onclick="history.back()">戻る</button>
    <button type="submit" class="btn green text-white w-25" id="bt-t">登録する</button>
  </div>
</form>
</div>
</body>



</html>
