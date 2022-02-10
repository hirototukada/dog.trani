<?php
require_once(ROOT_PATH .'/Models/Dog_questions.php');
class QuestionsController{
    private $request; //リクエストパラメータ(GET,POST)
    private $Questions;  //Questionsモデル。
  
    public function __construct(){
      // リクエストパラメーターの取得
      $this->request['get'] = $_GET;
      $this->request['post'] = $_POST;
  
      // モデルオブジェクトの生成
      $this->Questions = new Dog_questions();
    }
    /**
      *questionsテーブルの決められたものの削除機能
      *
      * @param integer $brog
      *@return Array
      */
    public function Post_question_Delete($brog){
        $result = $this->Questions->post_question_Delete($brog);
        return $result;
    }
    /**
      *questionテーブルの決められたデータ取得
      *
      * @param integer $brog
      *@return Array $return
      */
    public function Fetch_question(){
        $result = $this->Questions->fetch_question();
        return $result;
    }
    /**
      *questionテーブルの登録が3番目のデータ取得
      *
      * @param integer
      *@return Array $return
      */
    public function Fetch_post_question(){
        $result = $this->Questions->fetch_post_question();
        return $result;
    }
    /**
      *questionsテーブル削除機能
      *
      * @param integer $brog
      *@return Array
      */
    public function Question_Delete($brog){
        $result = $this->Questions->question_Delete($brog);
        return $result;
    }
    /**
      *questionテーブルの中の決められたidのデータ取得
      *
      * @param integer
      *@return Array $return
      */
    public function Fetch_question_id($get){
        $result = $this->Questions->fetch_question_id($get);
        return $result;
    }
    /**
      *questionテーブルにデータを追加
      *
      * @param integer $brog
      *@return Array $result
      */
    public function Insert_questions($brog){
        $result = $this->Questions->insert_questions($brog);
        return $result;
    }
    /**
      *questionテーブルの決められたデータ取得
      *
      * @param integer $brog
      *@return Array $return
      */
      public function Fetch_question_user($id){
        $result = $this->Questions->fetch_question_user($id);
        return $result;
    }
}