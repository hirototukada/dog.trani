<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
require_once(ROOT_PATH .'/Controllers/PlayerController.php');
$player = new PlayerController();
$traning = $player->Get_traning_date();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>質問画面</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>span{color: red;}</style>
</head>
  <header><?php include '../Views/animal/include/header1.php';?><header>
<body class="bg-light">
  <div class="align-items-center">
  <form action="question_check.php" method="post" class="bg-white border-g m-auto mt-5 rounded-3 p-4 w-50">
    <h2 class="text-center pb-3 mb-3 border-b green-text">プロに質問</h2>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">ユーザー名</label>
    <?php if (!empty($_SESSION['name_err'])): ?>
      <span><?=$_SESSION['name_err']?></span>
    <?php endif; ?>
    <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?=$_SESSION['name']?>">
    <div id="nameHelp" class="form-text">
    </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">メールアドレス</label>
    <?php if (!empty($_SESSION['email_err'])): ?>
      <span><?=$_SESSION['email_err']?></span>
    <?php elseif (!empty($_SESSION['email1_err'])): ?>
      <span><?=$_SESSION['email1_err']?></span>
    <?php endif; ?>
    <input type="text" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?=$_SESSION['email']?>">
  </div>
  <!-- カテゴリー -->
  <label for="exampleDataList" class="form-label">カテゴリー<span>*</span></label>
  <?php if (!empty($_SESSION['traning_err'])): ?>
    <span><?=$_SESSION['traning_err']?></span>
  <?php endif; ?>
  <select class="form-select" aria-label="Default select example" name="traning">
    <option value="">選択してください</option>
    <?php for ($i=0; $i < count($traning); $i++):?>
      <option value="<?=$traning[$i]['id']?>"><?=$traning[$i]['name']?></option>
    <?php endfor; ?>
  </select>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">質問内容</label>
  <?php if (!empty($_SESSION['body_err'])): ?>
    <span><?=$_SESSION['body_err']?></span>
  <?php endif; ?>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="body"></textarea>
  </div>
  <div class="border-t pt-3 text-center">
    <button type="button" class="btn btn-outline-secondary w-25" onclick="history.back()">戻る</button>
    <button type="submit" class="btn green text-white w-25" id="bt-t">登録確認</button>
  </div>
</form>
</div>
</body>
<?php
$_SESSION['name_err'] = array();
$_SESSION['email_err'] = array();
$_SESSION['email1_err'] = array();
$_SESSION['traning_err'] = array();
$_SESSION['body_err'] = array();
 ?>
</html>
