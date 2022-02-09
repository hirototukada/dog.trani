<?php
require_once(ROOT_PATH .'/Models/Dog_user.php');

class Dog_userController{
    private $request; //リクエストパラメータ(GET,POST)
    private $Dog_user;  //Dog_userモデル。
  
    public function __construct(){
      // リクエストパラメーターの取得
      $this->request['get'] = $_GET;
      $this->request['post'] = $_POST;
  
      // モデルオブジェクトの生成
      $this->Dog_user = new Dog_user();
    }
    // ログアウト機能
    public function Logout(){
        $this->Dog_user->logout();
    }
    /**
      *userテーブルからログインユーザーのすべてデータを取得
      *
      * @param $email,$password
      *@return Array $result
      */
    public function Get_usure($email){
        $result = $this->Dog_user->get_usure($email);
        return $result;
    }
    /**
      *userテーブルからユーザーのpasswordを更新
      *
      * @param $email
      *@return Array $result
      */
    public function Update_password($password,$brog){
        $result = $this->Dog_user->update_password($password,$brog);
        return $result;
    }
    /**
      *roleの切り替え
      *
      * @param $role
      *@return Array $result
      */
    public function Role($role){
        $result = $this->Dog_user->role($role);
        return $result;
    }
    /**
      *userテーブルからすべてデータを取得
      *
      * @param integer
      *@return Array $result
      */
    public function Fetch_user(){
        $result = $this->Dog_user->fetch_user();
        return $result;
    }
    /**
      *userテーブルにデータを追加
      *
      * @param integer $brog
      *@return Array $result
      */
    public function Insert_usure($brog){
        $result = $this->Dog_user->insert_usure($brog);
        return $result;
    }
    /**
      *userテーブル削除機能
      *
      * @param integer $brog
      *@return Array
      */
    public function User_Delete($brog){
        $result = $this->Dog_user->user_Delete($brog);
        return $result;
    }
}
?>