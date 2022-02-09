<?php
require_once(ROOT_PATH .'/Models/Player.php');

class PlayerController{
  private $request; //リクエストパラメータ(GET,POST)
  private $Player;  //Playerモデル。

  public function __construct(){
    // リクエストパラメーターの取得
    $this->request['get'] = $_GET;
    $this->request['post'] = $_POST;

    // モデルオブジェクトの生成
    $this->Player = new Player();
}
// ログアウト機能
public function Logout(){
  $this->Player->logout();
}
/**
  *postテーブルから条件に合ったものを抽出
  *
  * @param $brog
  *@return Array $result
  */
  public function Get_post_Date($brog){
    $result = $this->Player->get_post_Date($brog);
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
    $dog['dog'] = $this->Player->get_dog_nameDate($dog1);
    $dog['parsonality'] = $this->Player->get_parsonality_nameDate($parsonality);
    $dog['traning'] = $this->Player->get_traning_nameDate($traning);
    return $dog;
}
/**
  *traningテーブルの決められたデータを配列に
  *
  * @param $traning
  *@return Array $result
  */
public function get_traning($brog){
    $traning = $this->Player->get_traning_nameDate($brog);
    return $traning;
}
/**
  *postテーブルから全て抽出
  *
  * @param
  *@return Array $result
  */
  public function SearchAll(){
    $result = $this->Player->searchAll();
    return $result;
  }
  /**
    *postテーブルから条件に合ったものを抽出
    *
    * @param $brog
    *@return Array $result
    */
public function Search($brog){
  $result = $this->Player->search($brog);
  return $result;
}
public function index($brog){
  $page = 0;
  if (isset($this->request['get']['page'])) {
    $page = $this->request['get']['page'];
  }

  $players = $this->Player->search($page,$brog);
  $players_count = $this->Player->countFetch($brog,$page);
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

  $players = $this->Player->searchAll($page);
  $players_count = $this->Player->countAll();
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
  $result = $this->Player->get_dog_date();
  return $result;
}
/**
  *parsonalityテーブルからデータを全て抽出
  *
  * @param
  *@return Array $result
  */
public function Get_parsonality_date(){
  $result = $this->Player->get_parsonality_date();
  return $result;
}
/**
  *traningテーブルからデータを全て抽出
  *
  * @param
  *@return Array $result
  */
public function Get_traning_date(){
  $result = $this->Player->get_traning_date();
  return $result;
}
/**
  *条件にあったlikesのデータ取得
  *
  * @param integer
  *@return Array $return
  */
public function like($user_id,$post_id) {
        $likeBool = $this->Player->check_like_duplicate($user_id,$post_id);
        if(!$likeBool){
            $this->Player->registerLike($user_id,$post_id);
            $action = true;
            return $action;
        }else{
            $this->Player->clearLike($user_id,$post_id);
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
    $like = $this->Player->fetch_like_count($id);
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
    
      $players = $this->Player->fetch_like_user($page);
      $players_count = $this->Player->countLike();
      $params = [
        'players' => $players,
        'pages' => $players_count / 6
      ];
      return $params;
    }
     /**
    *commentテーブルに値を追加
    *
    * @param $brog
    *@return Array $return
    */
    public function commentPost($brog){
      $this->Player->comment($brog);
    }
    /**
              *commentテーブルの値を取得
              *
              *@param $brog
              *@return Array 
              */
    public function fetchComment($brog){
      $comment = $this->Player->fetch_comment($brog);
      return $comment;
    }
    /**
              *commentテーブルの値を取得
              *
              *@param $brog
              *@return Array 
              */
              public function fetchCommentAll($id){
                $comment = $this->Player->fetch_commentAll($id);
                return $comment;
              }
    /**
                *postテーブルの決められたデータ取得
                *
                * @param integer
                *@return Array $return
                */
                public function Get_post_limit(){
                  $result = $this->Player->get_post_limit();
                  return $result;
                }
     /**
                *questionテーブルの決められたデータ取得
                *
                * @param integer $brog
                *@return Array $return
                */
                public function Fetch_question_user($id){
                  $result = $this->Player->fetch_question_user($id);
                  return $result;
                }
      /**
            *userテーブルにデータを追加
            *
            * @param integer $brog
            *@return Array $result
            */
            public function Insert_questions($brog){
              $result = $this->Player->insert_questions($brog);
              return $result;
            }
      /**
            *userテーブルからログインユーザーのすべてデータを取得
            *
            * @param $email,$password
            *@return Array $result
            */
            public function Get_usure($email){
              $result = $this->Player->get_usure($email);
              return $result;
            }
      /**
            *userテーブルからユーザーのpasswordを更新
            *
            * @param $email
            *@return Array $result
            */
            public function Update_password($password,$brog){
              $result = $this->Player->update_password($password,$brog);
              return $result;
            }
      /**
            *roleの切り替え
            *
            * @param $role
            *@return Array $result
            */
            public function Role($role){
              $result = $this->Player->role($role);
              return $result;
            }
      /**
            *userテーブルからすべてデータを取得
            *
            * @param integer
            *@return Array $result
            */
            public function Fetch_user(){
              $result = $this->Player->fetch_user();
              return $result;
            }
      /**
            *userテーブルにデータを追加
            *
            * @param integer $brog
            *@return Array $result
            */
            public function Insert_usure($brog){
              $result = $this->Player->insert_usure($brog);
              return $result;
            }
      /**
              *postテーブル削除機能
              *
              * @param integer $brog
              *@return Array
              */
              public function Post_Delete($brog){
                $result = $this->Player->post_Delete($brog);
                return $result;
              }
      /**
              *questionsテーブルの決められたものの削除機能
              *
              * @param integer $brog
              *@return Array
              */
              public function Post_question_Delete($brog){
                $result = $this->Player->post_question_Delete($brog);
                return $result;
              }
      /**
                *questionテーブルの決められたデータ取得
                *
                * @param integer $brog
                *@return Array $return
                */
                public function Fetch_question(){
                  $result = $this->Player->fetch_question();
                  return $result;
                }
      /**
                *postテーブルにデータを追加
                *
                * @param integer $brog
                *@return Array $result
                */
                public function  Insert_post($brog){
                  $result = $this->Player-> insert_post($brog);
                  return $result;
                }
       /**
                *questionテーブルの登録が3番目のデータ取得
                *
                * @param integer
                *@return Array $return
                */
                public function Fetch_post_question(){
                  $result = $this->Player->fetch_post_question();
                  return $result;
                }     
       /**
                *postテーブル更新機能
                *
                * @param integer $brog
                *@return Array $return
                */    
                public function UP_date_Post($brog){
                  $result = $this->Player->UP_date_post($brog);
                  return $result;
                }          
        /**
              *questionsテーブル削除機能
              *
              * @param integer $brog
              *@return Array
              */
              public function Question_Delete($brog){
                $result = $this->Player->question_Delete($brog);
                return $result;
              }
         /**
                *questionテーブルの中の決められたidのデータ取得
                *
                * @param integer
                *@return Array $return
                */
                public function Fetch_question_id($get){
                  $result = $this->Player->fetch_question_id($get);
                  return $result;
                }   
          /**
              *userテーブル削除機能
              *
              * @param integer $brog
              *@return Array
              */
              public function User_Delete($brog){
                $result = $this->Player->user_Delete($brog);
                return $result;
              }
}
