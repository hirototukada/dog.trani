<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
require_once(ROOT_PATH .'/Models/validate.php');
require_once(ROOT_PATH .'/Controllers/PlayerController.php');
$player = new PlayerController();
$brog = $_POST;
$login = $_SESSION;
$post_crated = $player->Get_post_limit();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>一般ユーザー画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/page.css">
</head>
<body>
      <header><?php include '../Views/animal/include/header1.php';?><header>
        <div class='siba'>
          <div class="card m-auto" style="max-width: 80%;">
              <img class="card-img img-fluid hight:200px" src="/img/dog2.jpeg" alt="柴犬の Oslo Opera House" style="hight: 20rem;">
              <div class="card-img-overlay">
              <div class = 'text-end'>
                <img src="/img/logo (4).png" class="logo1" style="height:12rem" alt="ロゴ">
             </div>
          </div>
        </div>
        </div>
        <div class="mb-3">
          <!-- <div class="carousel-item active"> -->
            <div class="bg-white text-center p-2 mt-2"><h1>NewTopics</h1></div>
            <div class="d-flex justify-content-evenly p-3 rounded-pill">
              <?php for ($i = 0; $i < count($post_crated); $i++): ?>
                <div class="card w-25 p-2 green1" id="g">
                  <img src="<?=$post_crated[$i]['img']?>" style="height:20rem" class="card-img-top w-100 rounded-3" alt="...">
                  <div class="card-body">
                    <h5 class="card-title"><?=$post_crated[$i]['traning']?>について</h5>
                    <p class="card-text"><?=$post_crated[$i]['created_at']?></p>
                  </div>
                  <a href="../manage/detail.php?id=<?=$post_crated[$i]['id']?>" class="m-auto"><input type="button" class="green text-white border-0 rounded-pill px-4 py-1 h5" value="もっと見る"></a>
                </div>
              <?php endfor; ?>
          </div>
          <!-- </div> -->
        </div>
          <div class="d-flex justify-content-evenly mt-5">

            <button type="button" class="rounded-circle green ge border-0" c data-toggle="modal" data-target="#testModal">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
              </svg>検索する
            </button>
            <button type="button" class="rounded-circle ge" id="ge"><a href="question.php" class="g-a">
              <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-brush" viewBox="0 0 16 16">
              <path d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.067 6.067 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.117 8.117 0 0 1-3.078.132 3.658 3.658 0 0 1-.563-.135 1.382 1.382 0 0 1-.465-.247.714.714 0 0 1-.204-.288.622.622 0 0 1 .004-.443c.095-.245.316-.38.461-.452.393-.197.625-.453.867-.826.094-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.2-.925 1.746-.896.126.007.243.025.348.048.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.175-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04zM4.705 11.912a1.23 1.23 0 0 0-.419-.1c-.247-.013-.574.05-.88.479a11.01 11.01 0 0 0-.5.777l-.104.177c-.107.181-.213.362-.32.528-.206.317-.438.61-.76.861a7.127 7.127 0 0 0 2.657-.12c.559-.139.843-.569.993-1.06a3.121 3.121 0 0 0 .126-.75l-.793-.792zm1.44.026c.12-.04.277-.1.458-.183a5.068 5.068 0 0 0 1.535-1.1c1.9-1.996 4.412-5.57 6.052-8.631-2.591 1.927-5.566 4.66-7.302 6.792-.442.543-.796 1.243-1.042 1.826a11.507 11.507 0 0 0-.276.721l.575.575zm-4.973 3.04l.007-.005a.031.031 0 0 1-.007.004zm3.582-3.043l.002.001h-.002z"/>
            </svg>質問する
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
