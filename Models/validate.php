<?php
// CSR対策
function setToken(){
  $csrf_token = bin2hex(random_bytes(32));
  $_SESSION['csrf_token'] = $csrf_token;
  return $csrf_token;
}
/* 新規登録時のバリデーション
**
*引数     $brog
*返り値   $result
*/
function validation($brog,$check){
  $err = [];
  // if (!isset($_SESSION['csrf_token']) ||
  //     $brog['csrf_token'] !== $_SESSION['csrf_token']) {
  //   exit('不正なリクエストです。');
  // }
  $pas = 0;
  for ($i=0; $i < count($check); $i++) {
    if (password_verify($brog['password'], $check[$i]['password']) &&
        $brog['email'] == $check[$i]['email']) {
      $pas++;
    }elseif ($brog['email'] == $check[$i]['email']) {
      $pas++;
    }
  }
  unset($_SESSION['csrf_token']);
  if (empty($brog['name'])) {
    $err['name'] = '※氏名は必須入力です。20文字以内でご入力してください。';
  }
  if (!empty($brog['name']) && $brog['name'] < 21) {
    $err['name1'] = '※20文字以内でご入力してください。';
  }
  if (empty($brog['email'])) {
    $err['email'] = '※メールアドレスは必須入力です。';
  }
  if (!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",$brog["email"])) {
    $err['email1'] = '※メールアドレスは正しくご入力ください。';
  }
  if (!preg_match('/^[0-9]+$/',$brog['tel']) && !empty($brog['tel'])) {
    $err['tel'] = '※電話番号は0-9の数字のみでご入力ください。';
  }
  if (!preg_match('/\A[a-z\d]{8,100}+\z/i',$brog['password'])) {
    $err['password'] = 'パスワードは8~100文字以内、半角英数・記号のみ使用し、ご記入ください。';
  }
  if ($brog['password'] !== $brog['password_conf']) {
    $err['password1'] = '確認用パスワードと異なっています。';
  }
  if ($pas > 0) {
    $err['user'] = '既に存在しているユーザーです。';
  }
  if (count($err) > 0) {
    $_SESSION = $err;
    header('Location: sign.php');
    return;
  }
  if (count($err) === 0) {
      return true;
  }
}
/* ログイン時値の有無のバリデーション
**
*引数     $brog
*返り値   $result
*/
function login_validate_empty($brog){
  $err = [];
  if (empty($brog['email'])) {
    $err['msg1'] = '※メールアドレスを記入してください。';
  }
  if (empty($brog['password'])) {
    $err['msg2'] = '※パスワードを記入してください。';
  }
  if (count($err) > 0) {
    $_SESSION = $err;
    header('Location: ../login/login.php');
    return;
  }
  if (count($err) === 0) {
      return true;
  }
}
/* ログイン時のバリデーション
**
*引数     $brog,$user
*返り値   $_SESSION['login_user']
*/
function login_validate($brog,$user){
  if ($brog['email'] !== $user['email']) {
    $_SESSION['msg1'] = '※メールアドレスが一致しません。';
    header('Location: ../login/login.php');
    return ;
  }
  if (password_verify($brog['password'],$user['password'])) {
    session_regenerate_id(true);
    $_SESSION['login_user'] = $user;
    return $_SESSION['login_user'];
  }
  $_SESSION['msg2'] = '※パスワードが一致しません。';
  header('Location: ../login/login.php');
  return ;
}
// password_up.php
/* パスワード再設定時の値の有無のバリデーション
**
*引数     $brog
*返り値   $result
*/
function password_validate_empty($brog){
  $err = [];
  if (empty($brog['email'])) {
    $err['msg1'] = '※メールアドレスを記入してください。';
  }
  if (count($err) > 0) {
    $_SESSION = $err;
    header('Location: ../login/password.php');
    exit();
  }
  if (count($err) === 0) {
      return true;
  }
}
/* パスワード再設定時、ユーザーが存在しているかのバリデーション
**
*引数     $brog,$user
*返り値   $_SESSION['login_user']
*/
function login_validate_email($brog,$user){
  if ($brog['email'] !== $user['email']) {
    $_SESSION['msg2'] = '※メールアドレスが一致しません。';
    header('Location: ../login/password.php');
    return ;
  }
}
/* 質問投稿時のバリデーション
**
*引数     $brog
*返り値
*/
function question_validate($brog){
  $err = [];
  if (empty($brog['name'])) {
    $err['name_err'] = '※名前は必須入力です。';
  }
  if (empty($brog['email'])) {
    $err['email_err'] = '※メールアドレスは必須入力です。';
  }
  if (!preg_match("/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",$brog["email"])) {
    $err['email1_err'] = '※メールアドレスは正しくご入力ください。';
  }
  if (empty($brog['traning'])) {
    $err['traning_err'] = '※カテゴリーは必須です。';
  }
  if (empty($brog['body'])) {
    $err['body_err'] = '※質問内容は必須入力です。';
  }
  if (count($err) > 0) {
    $_SESSION['name_err'] = $err['name_err'];
    $_SESSION['email_err'] = $err['email_err'];
    $_SESSION['email1_err'] = $err['email1_err'];
    $_SESSION['traning_err'] = $err['traning_err'];
    $_SESSION['body_err'] = $err['body_err'];
    header('Location: ../mypage/question.php');
    return;
  }
  if (count($err) === 0) {
      return true;
  }
}
  /* 投稿時のバリデーション
  **
  *引数     $brog
  *返り値
  */
  function form_validate($brog){
    $err = [];
    if (empty($brog['name'])) {
      $err['name_err'] = '※犬の名前は必須入力です。';
    }
    if (empty($brog['dog'])) {
      $err['dog_err'] = '※犬種は必須入力です。';
    }
    if (empty($brog['traning'])) {
      $err['traning_err'] = '※トレーニングは必須入力です。';
    }
    if (empty($brog['parsonality'])) {
      $err['parsonality_err'] = '※性格は必須入力です。';
    }
    if (empty($brog['body'])) {
      $err['body_err'] = '※投稿内容は必須入力です。';
    }
    if (count($err) > 0) {
      $_SESSION['name_err'] = $err['name_err'];
      $_SESSION['dog_err'] = $err['dog_err'];
      $_SESSION['parsonality_err'] = $err['parsonality_err'];
      $_SESSION['traning_err'] = $err['traning_err'];
      $_SESSION['body_err'] = $err['body_err'];
      header('Location: ../manage/form.php');
      return ;
    }
    if (count($err) === 0) {
        return true;
    }
  }
  /* 投稿時の画像のバリデーション
  **
  *引数     $file
  *返り値
  */
  function img_validate($file){
    $err = [];
    $filename = basename($file['img']['name']);
    // ファイルサイズが1mb未満か
    if ($file['img']["size"] > 1048576 || $file['img']["error"] == 2) {
      $err['img_err'] = '※ファイルサイズは1MB未満にしてください。';
    }
    // 画像は拡張子か
    $allow_ext = array('jpg','jpeg','png');
    $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!in_array(strtolower($file_ext),$allow_ext)) {
      $err['extension_err'] = '※画像ファイルを添付してください。';
    }
    if (!is_uploaded_file($file['img']['tmp_name'])) {
      $err['tmp_name_err'] = '※ファイルが選択されていません。';
    }
    if (count($err) > 0) {
      $_SESSION['img_err'] = $err['img_err'];
      $_SESSION['extension_err'] = $err['extension_err'];
      $_SESSION['temp_name_err'] = $err['temp_name_err'];
      header('Location: ../manage/form.php');
      return ;
    }
    if (count($err) === 0) {
        return true;
    }
  }
?>
