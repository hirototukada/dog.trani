<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
require_once(ROOT_PATH .'/Controllers/PlayerController.php');
$player = new PlayerController();
$id = $_GET;
$brog = $player->get_post_Date($id['id']);
$dog = $player->get_name($brog['dog_id'],$brog['parsonality_id'],$brog['traning_id']);
$dog_t = $player->Get_dog_date();
$parsonality_t = $player->Get_parsonality_date();
$traning_t = $player->Get_traning_date();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>投稿編集画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/form.css">
</head>
<body>
  <header><?php include '../Views/animal/include/header2.php';?><header>



  <div class="align-items-center">
  <form action="my_check.php" enctype="multipart/form-data" method="post" class="bg-white border-g m-auto mt-5 rounded-3 p-4 w-50">
    <h2 class="text-center pb-3 mb-3 border-b green-text">新規投稿フォーム</h2>
    <div class="mb-3">
  <label for="formFile" class="form-label">写真・画像<span>*</span></label>
  <?php if (!empty($_SESSION['img_err'])): ?>
    <span><?=$_SESSION['img_err']?></span>
  <?php elseif (!empty($_SESSION['extension_err'])): ?>
    <span><?=$_SESSION['extension_err']?></span>
  <?php elseif (!empty($_SESSION['tmp_name_err'])): ?>
    <span><?=$_SESSION['tmp_name_err']?></span>
  <?php endif; ?>
  <input class="form-control" type="file" id="formFile" accept="image/*" name="img">
  <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
  <input type="hidden" name="id" value="<?=$id['id']?>">
</div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">わんちゃんの名前<span>*</span></label>
    <?php if (!empty($_SESSION['name_err'])): ?>
      <span><?=$_SESSION['name_err']?></span>
    <?php endif; ?>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name" value="<?=$brog['name']?>">
  </div>
  <!-- カテゴリー -->
  <div class="mb-3">
  <label for="exampleDataList" class="form-label">犬種名<span>*</span></label>
  <?php if (!empty($_SESSION['dog_err'])): ?>
    <span><?=$_SESSION['dog_err']?></span>
  <?php endif; ?>
  <select class="form-select" aria-label="Default select example" name="dog">
    <option value="<?=$brog['dog_id']?>"><?=$dog['dog']['name']?></option>
    <?php for ($i=0; $i < count($dog); $i++):?>
      <option value="<?=$dog[$i]['id']?>"><?=$dog[$i]['name']?></option>
    <?php endfor; ?>
  </select>
  </div>
  <!-- カテゴリー -->
  <div class="mb-3">
  <label for="exampleDataList" class="form-label">トレーニング<span>*</span></label>
  <?php if (!empty($_SESSION['traning_err'])): ?>
    <span><?=$_SESSION['traning_err']?></span>
  <?php endif; ?>
  <select class="form-select" aria-label="Default select example" name="traning">
    <option value="<?=$brog['traning_id']?>"><?=$dog['traning']['name']?></option>
    <?php for ($i=0; $i < count($traning_t); $i++): ?>
      <option value="<?=$traning_t[$i]['id']?>"><?=$traning_t[$i]['name']?></option>
    <?php endfor; ?>
  </select>
  </div>
  <!-- カテゴリー -->
  <div class="mb-3">
  <label for="exampleDataList" class="form-label">性格<span>*</span></label>
  <?php if (!empty($_SESSION['parsonality_err'])): ?>
    <span><?=$_SESSION['parsonality_err']?></span>
  <?php endif; ?>
  <select class="form-select" aria-label="Default select example" name="parsonality">
    <option value="<?=$brog['parsonality_id']?>"><?=$dog['parsonality']['name']?></option>
    <?php for ($i=0; $i < count($parsonality_t); $i++): ?>
      <option value="<?=$parsonality_t[$i]['id']?>"><?=$parsonality_t[$i]['name']?></option>
    <?php endfor; ?>
  </select>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">投稿内容</label>
  <?php if (!empty($_SESSION['body_err'])): ?>
    <span><?=$_SESSION['body_err']?></span>
  <?php endif; ?>
  <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="body"><?=$brog['body']?></textarea>
  </div>
  <div class="border-t pt-3 text-center">
    <button type="button" class="btn btn-outline-secondary w-25" onclick="history.back()">戻る</button>
    <button type="submit" class="btn green text-white w-25" id="bt-t">登録確認</button>
  </div>
</form>
</div>


</body>

<?php
$_SESSION['img_err']         = array();
$_SESSION['extension_err']   = array();
$_SESSION['temp_name_err']   = array();
$_SESSION['name_err']        = array();
$_SESSION['dog_err']         = array();
$_SESSION['traning_err']     = array();
$_SESSION['parsonality_err'] = array();
$_SESSION['body_err']        = array();
 ?>

</html>
