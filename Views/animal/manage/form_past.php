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
$user = $Questions->Fetch_question();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>質問一覧</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/page.css">
</head>
  <body class="bg-light">
    <div class="text-center p-2"><h1>質問一覧</h1></div>
    <div class="col-9 m-auto">
        <table class="table table-bordered">
            <thead class="green text-white h5 p-2">
                <tr>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>カテゴリー</th>
                    <th>質問内容</th>
                    <th>質問時間</th>
                    <th>詳細</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody class="green-text bg-white">
              <?php for ($i=0; $i < count($user); $i++): ?>
                <tr>
                    <td><?=$user[$i]['name']?></td>
                    <td><?=$user[$i]['email']?></td>
                    <td><?=$user[$i]['traning']?></td>
                    <td><?=$user[$i]['body']?></td>
                    <td><?=$user[$i]['created_at']?></td>
                    <td><a href="../manage/question_detail.php?id=<?=$user[$i]['id']?>">詳細</a></td>
                    <td><a href="../manage/question_delete.php?id=<?=$user[$i]['id']?>" onclick="return confirm('削除します。よろしいですか？')">削除</a></td>
                </tr>
              <?php endfor;?>
            </tbody>
        </table>
        <div class="text-center">
        <a href="manage.php" class="btn green text-white w-25">マイページへ</a>
        </div>
    </div>
</body>
</html>
