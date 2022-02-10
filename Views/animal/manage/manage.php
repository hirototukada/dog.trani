<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
include '../Views/animal/include/header2.php';
$login = $_SESSION;
$post_crated = $Questions->Fetch_post_question();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>管理者ユーザー画面</title>
    <style>span{font-weight: bold; font-size: 26px;}</style>
</head>
  <div class="mb-3">
      <div class="bg-white text-center p-2"><h1>NewQuestions</h1></div>
      <div class="d-flex justify-content-evenly p-3 rounded-pill">
        <?php for ($i = 0; $i < count($post_crated); $i++): ?>
          <div class="card w-25 p-2 green1" id="g">
            <div class="card-body">
              <h5 class="card-title"><span><?=$post_crated[$i]['traning_name']?>のジャンル</span>についてのご質問</h5>
              <p class="card-text"><?=$post_crated[$i]['created_at']?></p>
            </div>
            <a href="../manage/question_detail.php?id=<?=$post_crated[$i]['id']?>" class="m-auto"><input type="button" class="green text-white border-0 rounded-pill px-4 py-1 h5" value="もっと見る"></a>
          </div>
        <?php endfor; ?>
    </div>
  </div>
  <div class="d-flex justify-content-evenly mt-5">

  <button type="button" class="rounded-circle green ge border-0" c data-toggle="modal" data-target="#testModal">
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
    </svg>検索する
  </button>
  <button type="button" class="rounded-circle ge" id="ge"><a href="form.php" class="g-a">
    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
      <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
    </svg>投稿する
    </a>
  </button>
</div>
<div class = 'w-50 d-flex justify-content-between h-100 m-auto mt-3'>
            <div class = 'rounded-circle border-g  smoke'></div>
            <div class = 'rounded-circle border-g  smoke'></div>
          </div>
  <div>
  <div class="text-center"><img src="/img/dog1.png"></img></div>
</div>
</body>
</html>
