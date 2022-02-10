<?php
require_once(ROOT_PATH .'/Models/validate.php');
class ValidateController{
    private $request; //リクエストパラメータ(GET,POST)
    private $Validation;  //Dog_likeモデル。
  
    public function __construct(){
      // リクエストパラメーターの取得
      $this->request['get'] = $_GET;
      $this->request['post'] = $_POST;
  
      // モデルオブジェクトの生成
      $this->Validation = new Validation();
    }
    /* 新規登録時のバリデーション
    **
    *引数     $brog
    *返り値   $result
    */
    public function ValidateUser($brog,$user){
        $this->Validation->validation($brog,$user);
    }
    /* ログイン時値の有無のバリデーション
    **
    *引数     $brog
    *返り値   $result
    */
    public function LoginValidationEmpty($brog){
        $this->Validation->login_validate_empty($brog);
    }
    /* ログイン時のバリデーション
    **
    *引数     $brog,$user
    *返り値   $_SESSION['login_user']
    */
    public function LoginValidation($brog,$user){
        $this->Validation->login_validate($brog,$user);
    }
    /* パスワード再設定時の値の有無のバリデーション
    **
    *引数     $brog
    *返り値   $result
    */
    public function PasswordValidationEmpty($brog){
        $this->Validation->password_validate_empty($brog);
    }
    /* パスワード再設定時、ユーザーが存在しているかのバリデーション
    **
    *引数     $brog,$user
    *返り値   $_SESSION['login_user']
    */
    public function LoginValidationEmail($brog,$user){
        $this->Validation->login_validate_email($brog,$user);
    }
    /* 質問投稿時のバリデーション
    **
    *引数     $brog
    *返り値
    */
    public function QuestionValidation($brog){
        $this->Validation->question_validate($brog);
    }
    /* 投稿時のバリデーション
    **
    *引数     $brog
    *返り値
    */
    public function FormValdation($brog){
        $this->Validation->form_validate($brog);
    }
    /* 投稿時の画像のバリデーション
    **
    *引数     $file
    *返り値
    */
    public function ImgValidation($file){
        $this->Validation->img_validate($file);
    }
}