<?php
require_once(ROOT_PATH .'/Models/Dog_post.php');
require_once(ROOT_PATH .'/Models/Dog_comment.php');


class Dog_postController{
  private $request; //リクエストパラメータ(GET,POST)
  private $dog_post;  //dog_postモデル。
  private $Comment;  //commentモデル。

  public function __construct(){
    // リクエストパラメーターの取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    // モデルオブジェクトの生成
    $this->dog_post = new dog_post();
    // Commentモデルと連携
    $dbh = $this->dog_post->get_db_handler();
    $this->Comment = new Comment($dbh);
}

/**
  *postテーブルから条件に合ったものを抽出
  *
  * @param $brog
  *@return Array $result
  */
  public function Get_post_Date($brog){
    $result = $this->dog_post->get_post_Date($brog);
    return $result;
  }
/**
  *dog,parsonality,traningテーブルの決められたデータを配列に
  *
  * @param $dog1,$parsonality,$traning
  *@return Array $result
  */
public function get_name($dog1,$parsonality,$traning){
    $dog = [];
    $dog['dog'] = $this->dog_post->get_dog_nameDate($dog1);
    $dog['parsonality'] = $this->dog_post->get_parsonality_nameDate($parsonality);
    $dog['traning'] = $this->dog_post->get_traning_nameDate($traning);
    return $dog;
}
/**
  *traningテーブルの決められたデータを配列に
  *
  * @param $traning
  *@return Array $result
  */
public function get_traning($brog){
    $traning = $this->dog_post->get_traning_nameDate($brog);
    return $traning;
}
/**
  *postテーブルから全て抽出
  *
  * @param
  *@return Array $result
  */
  public function SearchAll(){
    $result = $this->dog_post->searchAll();
    return $result;
  }
/**
  *postテーブルから条件に合ったものを抽出
  *
  * @param $brog
  *@return Array $result
  */
public function Search($brog){
  $result = $this->dog_post->search($brog);
  return $result;
}
public function index($brog){
  $page = 0;
  if (isset($this->request['get']['page'])) {
    $page = $this->request['get']['page'];
  }

  $players = $this->dog_post->search($page,$brog);
  $players_count = count($players);
  $params = [
    'players' => $players,
    'pages' => $players_count / 6
  ];
  return $params;
}
public function indexAll(){
  $page = 0;
  if (isset($this->request['get']['page'])) {
    $page = $this->request['get']['page'];
  }

  $players = $this->dog_post->searchAll($page);
  $players_count = $this->dog_post->countAll();
  $params = [
    'players' => $players,
    'pages' => $players_count / 6
  ];
  return $params;
}
/**
  *dogテーブルからデータを全て抽出
  *
  * @param
  *@return Array $result
  */
public function Get_dog_date(){
  $result = $this->dog_post->get_dog_date();
  return $result;
}
/**
  *parsonalityテーブルからデータを全て抽出
  *
  * @param
  *@return Array $result
  */
public function Get_parsonality_date(){
  $result = $this->dog_post->get_parsonality_date();
  return $result;
}
/**
  *traningテーブルからデータを全て抽出
  *
  * @param
  *@return Array $result
  */
public function Get_traning_date(){
  $result = $this->dog_post->get_traning_date();
  return $result;
}
/**
  *commentテーブルに値を追加
  *
  * @param $brog
  *@return Array $return
  */
public function commentPost($brog){
      $this->Comment->comment($brog);
}
/**
  *commentテーブルの値を取得
  *
  *@param $brog
  *@return Array 
  */
public function fetchComment($brog){
      $comment = $this->Comment->fetch_comment($brog);
      return $comment;
}
/**
  *commentテーブルの値を取得
  *
  *@param $brog
  *@return Array 
  */
public function fetchCommentAll($id){
     $comment = $this->Comment->fetch_commentAll($id);
     return $comment;
}
/**
  *postテーブルの決められたデータ取得
  *
  * @param integer
  *@return Array $return
  */
public function Get_post_limit(){
     $result = $this->dog_post->get_post_limit();
     return $result;
}
 /**
   *postテーブル削除機能
   *
   * @param integer $brog
   *@return Array
   */
 public function Post_Delete($brog){
    $result = $this->dog_post->post_Delete($brog);
    return $result;
 }
 /**
   *postテーブルにデータを追加
   *
   * @param integer $brog
   *@return Array $result
   */
 public function  Insert_post($brog){
     $result = $this->dog_post-> insert_post($brog);
     return $result;
 }
      
 /**
   *postテーブル更新機能
   *
   * @param integer $brog
   *@return Array $return
   */    
 public function UP_date_Post($brog){
    $result = $this->dog_post->UP_date_post($brog);
    return $result;
 }            
}
