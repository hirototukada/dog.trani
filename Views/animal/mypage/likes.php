<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
include '../Views/animal/include/header1.php';
$params = $like->likeAll();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>検索結果一覧画面</title>
<style>
.wa{
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
  width: 70%;
  margin: auto;
}
</style>
</head>
<body>
      <div class="mt-3 w-75 m-auto"><h2 class="mt-4">検索結果</h2></div>
      <?php if (empty($params['players'])): ?>
          <?php echo '検索結果はありません。'; ?>
      <?php else: ?>
        <div class="wa mt-4">
        <?php for ($i=0; $i < count($params['players']); $i++): ?>
          <div class="card mt-4" style="width: 20rem;">
        <img src="<?=$params['players'][$i]['img']?>" class="card-img-top" style="height:15rem">
        <div class="card-body">
          <h5 class="card-title"><?=$params['players'][$i]['traning_name']?>について</h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">犬種：<?=$params['players'][$i]['dog_name']?></li>
          <li class="list-group-item">性格：<?=$params['players'][$i]['parsonality_name']?></li>
        </ul>
        <div class="card-body">
          <a href="../mypage/mypage.php?id=<?php echo $params['players'][$i]['id'] ?>" class="card-link">マイページへ</a>
          <a href="../manage/detail.php?id=<?php echo $params['players'][$i]['id'] ?>" class="card-link">詳細</a>
        </div>
      </div>
    <?php endfor; ?>
  </div>
  <?php endif; ?>
  <nav aria-label="Page navigation example">
  <ul class="pagination pagination-lg justify-content-center mt-3">
    <?php for ($i=0; $i <=$params['pages']; $i++):?>
      <?php if (isset($_GET['page'])&& $_GET['page'] == $i): ?>
        <?php echo $i+1;?>
      <?php else:?>
        <li class="page-item"><a class = "page-link" href='?page=<?=$i?>'><?=$i+1?></a></li>
      <?php endif; ?>
  <?php endfor;?>
  </ul>
</nav>
  </body>
</html>