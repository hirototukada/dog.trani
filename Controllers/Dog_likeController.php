<?php
require_once(ROOT_PATH .'/Models/Dog_like.php');
class LikeController{
    private $request; //リクエストパラメータ(GET,POST)
    private $Dog_like;  //Dog_likeモデル。
  
    public function __construct(){
      // リクエストパラメーターの取得
      $this->request['get'] = $_GET;
      $this->request['post'] = $_POST;
  
      // モデルオブジェクトの生成
      $this->Dog_like = new Dog_like();
    }
    /**
     *条件にあったlikesのデータ取得
    *
    * @param integer
    *@return Array $return
    */
    public function like($user_id,$post_id) {
        $likeBool = $this->Dog_like->check_like_duplicate($user_id,$post_id);
        if(!$likeBool){
            $this->Dog_like->registerLike($user_id,$post_id);
            $action = true;
            return $action;
        }else{
            $this->Dog_like->clearLike($user_id,$post_id);
            $action = false;
            return $action;
        }
    }
    /**
    *likeテーブルの数を出す
    *
    * @param 
    *@return Array $like
    */
    public function like_Count($id){
        $like = $this->Dog_like->fetch_like_count($id);
        return $like;
    }
    /**
    *いいねされているpostテーブルの数を出す
    *
    * @param $page = 0
    *@return Array $return
    */
    public function likeAll(){
        $page = 0;
        if (isset($this->request['get']['page'])) {
            $page = $this->request['get']['page'];
        }

        $players = $this->Dog_like->fetch_like_user($page);
        $countlike = $this->Dog_like->countLike();
        $params = [
            'players' => $players,
            'pages' => $countlike / 6
        ];
        return $params;
    }
}
?>