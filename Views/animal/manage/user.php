<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: ../login/login.php');
  }
session_start();
include '../Views/animal/include/header2.php';
$user = $users->Fetch_user();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>ユーザー一覧</title>
</head>
  <body class="bg-light">
    <div class="text-center p-2"><h1>ユーザー一覧</h1></div>
    <div class="col-9 m-auto">
        <table class="table table-bordered">
            <thead class="green text-white h5 p-2">
                <tr>
                    <th>ユーザー名</th>
                    <th>メールアドレス</th>
                    <th>電話番号</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody class="green-text bg-white">
              <?php for ($i=0; $i < count($user); $i++): ?>
                <tr>
                    <td><?=$user[$i]['name']?></td>
                    <td><?=$user[$i]['email']?></td>
                    <td><?=$user[$i]['tel']?></td>
                    <td><a href="../manage/user_delete.php?id=<?=$user[$i]['id'] ?>" onclick="return confirm('削除します。よろしいですか？')">削除</a></td>
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
