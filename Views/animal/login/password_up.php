<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
session_start();
require_once(ROOT_PATH .'/Models/validate.php');
require_once(ROOT_PATH .'/Controllers/PlayerController.php');
$player = new PlayerController();
$brog = $_POST;
password_validate_empty($brog);
$user = $player->Get_usure($brog['email']);
login_validate_email($brog,$user);
$password = bin2hex(random_bytes(5));
$player->Update_password($password,$brog);
// メール送信可能
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// 設置した場所のパスを指定する
require_once(ROOT_PATH .'/PHPMailer-master/PHPMailer-master/src/PHPMailer.php');
require_once(ROOT_PATH .'/PHPMailer-master/PHPMailer-master/src/Exception.php');
require_once(ROOT_PATH .'/PHPMailer-master/PHPMailer-master/src/SMTP.php');
// 文字エンコードを指定
mb_language('uni');
mb_internal_encoding('UTF-8');

// インスタンスを生成（true指定で例外を有効化）
$mail = new PHPMailer(true);

// 文字エンコードを指定
$mail->CharSet = 'utf-8';

try {
  // デバッグ設定
  // $mail->SMTPDebug = 2; // デバッグ出力を有効化（レベルを指定）
  // $mail->Debugoutput = function($str, $level) {echo "debug level $level; message: $str<br>";};

  // SMTPサーバの設定
  $mail->isSMTP();                          // SMTPの使用宣言
  $mail->Host       = 'smtp.mailtrap.io';   // SMTPサーバーを指定
  $mail->SMTPAuth   = true;                 // SMTP authenticationを有効化
  $mail->Username   = '82d4a3c9ef9b75';   // SMTPサーバーのユーザ名
  $mail->Password   = '69a71f9e2d90b0';           // SMTPサーバーのパスワード
  $mail->SMTPSecure = 'tls';  // 暗号化を有効（tls or ssl）無効の場合はfalse
  $mail->Port       = 2525; // TCPポートを指定（tlsの場合は465や587）

  // 送受信先設定（第二引数は省略可）
  $mail->setFrom('from@example.com', '差出人名'); // 送信者
  $mail->addAddress($brog['email'], '受信者名');   // 宛先
  $mail->addReplyTo('replay@example.com', 'お問い合わせ'); // 返信先
  $mail->addCC('cc@example.com', '受信者名'); // CC宛先
  $mail->Sender = 'return@example.com'; // Return-path

  // 送信内容設定
  $mail->Subject = 'password再発行';
  $mail->Body    = $password;

  // 送信
  $mail->send();
} catch (Exception $e) {
  // エラーの場合
  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>パスワード再発行完了</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="/css/header.css">
</head>
<body class="bg-light">
  <form class="h-100 mt-4 p-5">
    <div class="w-50 m-auto mt-4 border-g bg-white p-3">
      <h2 class="green-text text-center border-b pb-2">Wonderful</h2>
          <p class="g-p green-text pt-3 text-center">パスワード再発行完了しました。</p>
          <p class="g-p green-text text-center">ご確認いただきありがとうございます。</p>
      </div>
  </form>
  <div class="text-center"><a href="login.php" class="btn green text-white w-25">ログイン画面へ</a></div>
</body>
</html>
