<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Player extends Db{
    private $table = 'user';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }
    /**
      *userテーブルにデータを追加
      *
      * @param integer $brog
      *@return Array $result
      */
    public function insert_usure($brog){
      $sql = 'INSERT INTO user(name,email,tel,password)
              VALUES (:name,:email,:tel,:password)';
      $this->dbh->beginTransaction();
      try {
        $sth = $this->dbh->prepare($sql);
        $password = password_hash($brog['password'],PASSWORD_DEFAULT);
        $sth->bindParam(':name',$brog['name'],PDO::PARAM_STR);
        $sth->bindParam(':email',$brog['email'],PDO::PARAM_STR);
        $sth->bindParam(':tel',$brog['tel'],PDO::PARAM_INT);
        $sth->bindParam(':password',$password,PDO::PARAM_STR);
        $result = $sth->execute();
        $this->dbh->commit();
        return $result;
      } catch (PDOException $e) {
        $this->dbh->rollBack();
        echo $e->getMessage();
        exit();
      }
    }
    /**
      *userテーブルからすべてデータを取得
      *
      * @param integer
      *@return Array $result
      */
      public function fetch_user(){
        $sql = 'SELECT * FROM user';
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
      }
      /**
        *userテーブルからログインユーザーのすべてデータを取得
        *
        * @param $email,$password
        *@return Array $result
        */
        public function get_usure($email){
          $sql = 'SELECT * FROM user WHERE email = :email';
          $sth = $this->dbh->prepare($sql);
          $sth->bindParam(':email',$email,PDO::PARAM_STR);
          $sth->execute();
          $result = $sth->fetch(PDO::FETCH_ASSOC);
          return $result;
        }
        /**
          *roleの切り替え
          *
          * @param $role
          *@return Array $result
          */
        public function role($role){
          if ($role['role'] == 1) {
            $_SESSION = $role;
            header('Location: ../mypage/mypage.php');
            return ;
          }elseif ($role['role'] == 2) {
            $_SESSION = $role;
            header('Location: ../manage/manage.php');
            return ;
          }
        }
        // ログアウト機能
        public function logout(){
          $_SESSION = array();
          session_destroy();
        }
        /**
          *userテーブルからユーザーのpasswordを更新
          *
          * @param $email
          *@return Array $result
          */
          public function update_password($password,$brog){
            $sql = 'UPDATE user SET password = :password
                    WHERE email = :email';
            $password_hash = password_hash($password,PASSWORD_DEFAULT);
            $this->dbh->beginTransaction();
            try {
              $sth = $this->dbh->prepare($sql);
              $sth->bindParam(':password',$password_hash,PDO::PARAM_STR);
              $sth->bindParam(':email',$brog['email'],PDO::PARAM_STR);
              $sth->execute();
              $this->dbh->commit();
            } catch (PDOException $e) {
              $this->dbh->rollBack();
              echo $e->getMessage();
              exit();
            }
          }
           /**
            *userテーブルの条件に合う全てのデータを取得
            *
            * @param
            *@return Array $result
            */
            public function get_user_fetch($brog){
              $sql = 'SELECT * FROM user
                      WHERE id = :id';
              $sth = $this ->dbh->prepare($sql);
              $sth->bindParam(':id',$brog['id'],PDO::PARAM_INT);
              $sth->execute();
              $result = $sth->fetch(PDO::FETCH_ASSOC);
              return $result;
            }
          /**
            *dogテーブルの全てのデータを取得
            *
            * @param
            *@return Array $result
            */
          public function get_dog_date(){
            $sql = 'SELECT * FROM dog';
            $sth = $this ->dbh->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          }
          /**
            *parsonalityテーブルの全てのデータを取得
            *
            * @param
            *@return Array $result
            */
          public function get_parsonality_date(){
            $sql = 'SELECT * FROM parsonality';
            $sth = $this ->dbh->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          }
          /**
            *traningテーブルの全てのデータを取得
            *
            * @param
            *@return Array $result
            */
          public function get_traning_date(){
            $sql = 'SELECT * FROM traning';
            $sth = $this ->dbh->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          }
          /**
            *dogテーブルの決められたデータを取得
            *
            * @param $brog
            *@return Array $result
            */
          public function get_dog_nameDate($brog){
            $sql = 'SELECT name FROM dog WHERE id = :id';
            $sth = $this ->dbh->prepare($sql);
            $sth->bindParam(':id',$brog,PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
          }
          /**
            *parsonalityテーブルの決められたデータを取得
            *
            * @param $brog
            *@return Array $result
            */
          public function get_parsonality_nameDate($brog){
            $sql = 'SELECT name FROM parsonality WHERE id = :id';
            $sth = $this ->dbh->prepare($sql);
            $sth->bindParam(':id',$brog,PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
          }
          /**
            *traningテーブルの決められたデータを取得
            *
            * @param $brog
            *@return Array $result
            */
          public function get_traning_nameDate($brog){
            $sql = 'SELECT name FROM traning WHERE id = :id';
            $sth = $this ->dbh->prepare($sql);
            $sth->bindParam(':id',$brog,PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
          }
          /**
            *postテーブルの決められたデータを取得
            *
            * @param $brog
            *@return Array $result
            */
          public function get_post_Date($brog){
            $sql = 'SELECT * FROM post WHERE id = :id';
            $sth = $this ->dbh->prepare($sql);
            $sth->bindParam(':id',$brog,PDO::PARAM_STR);
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result;
          }
          /**
            *postテーブルにデータを追加
            *
            * @param integer $brog
            *@return Array $result
            */
          public function insert_post($brog){
            $sql = 'INSERT INTO post(img,name,dog_id,parsonality_id,traning_id,body)
                    VALUES (:img,:name,:dog_id,:parsonality_id,:traning_id,:body)';
            $this->dbh->beginTransaction();
            try {
              $sth = $this->dbh->prepare($sql);
              $sth->bindParam(':img',$brog['img'],PDO::PARAM_STR);
              $sth->bindParam(':name',$brog['name'],PDO::PARAM_STR);
              $sth->bindParam(':dog_id',$brog['dog1'],PDO::PARAM_INT);
              $sth->bindParam(':parsonality_id',$brog['parsonality'],PDO::PARAM_INT);
              $sth->bindParam(':traning_id',$brog['traning'],PDO::PARAM_INT);
              $sth->bindParam(':body',$brog['body'],PDO::PARAM_STR);
              $result = $sth->execute();
              $this->dbh->commit();
              return $result;
            } catch (PDOException $e) {
              $this->dbh->rollBack();
              echo $e->getMessage();
              exit();
            }
          }
          /**
            *userテーブルにデータを追加
            *
            * @param integer $brog
            *@return Array $result
            */
          public function insert_questions($brog){
            $sql = 'INSERT INTO questions(name_id,email,traning_id,body)
                    VALUES (:name_id,:email,:traning_id,:body)';
            $this->dbh->beginTransaction();
            try {
              $sth = $this->dbh->prepare($sql);
              $sth->bindParam(':name_id',$brog['id'],PDO::PARAM_INT);
              $sth->bindParam(':email',$brog['email'],PDO::PARAM_STR);
              $sth->bindParam(':traning_id',$brog['traning'],PDO::PARAM_INT);
              $sth->bindParam(':body',$brog['body'],PDO::PARAM_STR);
              $result = $sth->execute();
              $this->dbh->commit();
              return $result;
            } catch (PDOException $e) {
              $this->dbh->rollBack();
              echo $e->getMessage();
              exit();
            }
          }
          public function findAll($page = 0):Array{
            $sql = 'SELECT *
                    FROM post';
            $sql .=' LIMIT 6 OFFSET '.(6*$page);
            $sth = $this->dbh->prepare($sql);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            return $result;
          }
          /**
            *検索機能
            *
            * @param integer $brog
            *@return Array $result
            */
            public function searchAll($page = 0):Array{
              $sql = 'SELECT p.id,p.img,p.name AS nick,g.name AS "dog_name",p1.name AS "parsonality_name",t.name AS "traning_name",p.body,p.created_at
                      FROM post p
                      JOIN dog g ON g.id = p.dog_id
                      JOIN parsonality p1 ON p1.id = p.parsonality_id
                      JOIN traning t ON t.id = p.traning_id
                      ORDER BY p.created_at DESC';
              $sql .=' LIMIT 6 OFFSET '.(6*$page);
              $sth = $this->dbh->prepare($sql);
              $sth->execute();
              $return = $sth->fetchAll(PDO::FETCH_ASSOC);
              return $return;
            }
          /**
            *検索機能
            *
            * @param integer $brog
            *@return Array $result
            */
            public function search($page,$brog){
              $page = 0;
              $sql = 'SELECT p.id,p.img,p.name AS nick,g.name AS "dog_name",p1.name AS "parsonality_name",t.name AS "traning_name",p.body,p.created_at
                      FROM post p
                      JOIN dog g ON g.id = p.dog_id
                      JOIN parsonality p1 ON p1.id = p.parsonality_id
                      JOIN traning t ON t.id = p.traning_id
                      WHERE g.id = :dog OR p1.id = :parsonality OR t.id = :traning OR p.body  LIKE :body
                      ORDER BY p.created_at DESC';
              if (!empty($brog['search'])) {
                $brog['search'] = "%".$brog['search']."%";
              }
              $sql .=' LIMIT 6 OFFSET '.(6*$page);
              $sth = $this->dbh->prepare($sql);
              $sth->bindParam(':dog',$brog['dog'],PDO::PARAM_INT);
              $sth->bindParam(':parsonality',$brog['parsonality'],PDO::PARAM_INT);
              $sth->bindParam(':traning',$brog['traning'],PDO::PARAM_INT);
              $sth->bindParam(':body',$brog['search'],PDO::PARAM_STR);
              $sth->execute();
              $return = $sth->fetchAll(PDO::FETCH_ASSOC);
              return $return;
            }
            /**
              *ページング機能
              *
              * @param integer
              *@return Array $count
              */
            public function countAll():Int{
              $sql = 'SELECT count(*) as count FROM post';
              $sth = $this->dbh->prepare($sql);
              $sth->execute();
              $count = $sth->fetchColumn();
              return $count;
            }
            /**
              *ページング機能
              *
              * @param integer
              *@return Array $count
              */
              public function countFetch($brog,$page){
                $page = 0;
                $sql = 'SELECT count(*) as count
                        FROM post p
                        JOIN dog g ON g.id = p.dog_id
                        JOIN parsonality p1 ON p1.id = p.parsonality_id
                        JOIN traning t ON t.id = p.traning_id
                        WHERE g.id = :dog OR p1.id = :parsonality OR t.id = :traning OR p.body  LIKE :body
                        ORDER BY p.created_at DESC';
                if (!empty($brog['search'])) {
                  $brog['search'] = "%".$brog['search']."%";
                }
                $sql .=' LIMIT 6 OFFSET '.(6*$page);
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':dog',$brog['dog'],PDO::PARAM_INT);
                $sth->bindParam(':parsonality',$brog['parsonality'],PDO::PARAM_INT);
                $sth->bindParam(':traning',$brog['traning'],PDO::PARAM_INT);
                $sth->bindParam(':body',$brog['search'],PDO::PARAM_STR);
                $sth->execute();
                $count = $sth->fetchColumn();
                return $count;
              }
            /**
              *userテーブル削除機能
              *
              * @param integer $brog
              *@return Array
              */
            public function user_Delete($brog){
              $this->dbh->beginTransaction();
              try {
                $sql = 'DELETE FROM user WHERE id = :id';
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':id',$brog['id'],PDO::PARAM_INT);
                $sth->execute();
                $this->dbh->commit();
              } catch (PDOException $e) {
                $this->dbh->rollBack();
                  echo $e->getMessage();
                  exit();
              }
            }
            /**
              *questionsテーブル削除機能
              *
              * @param integer $brog
              *@return Array
              */
            public function question_Delete($brog){
              $this->dbh->beginTransaction();
              try {
                $sql = 'DELETE FROM questions WHERE id = :id';
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':id',$brog['id'],PDO::PARAM_INT);
                $sth->execute();
                $this->dbh->commit();
              } catch (PDOException $e) {
                $this->dbh->rollBack();
                  echo $e->getMessage();
                  exit();
              }
              
            }
            /**
              *questionsテーブルの決められたものの削除機能
              *
              * @param integer $brog
              *@return Array
              */
            public function post_question_Delete($brog){
              $this->dbh->beginTransaction();
              try {
                $sql = 'DELETE FROM questions
                        WHERE name_id = :name_id';
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':name_id',$brog['id'],PDO::PARAM_INT);
                $sth->execute();
                $this->dbh->commit();
              } catch (PDOException $e) {
                $this->dbh->rollBack();
                  echo $e->getMessage();
                  exit();
              }
            }
            /**
              *postテーブル削除機能
              *
              * @param integer $brog
              *@return Array
              */
            public function post_Delete($brog){
              $this->dbh->beginTransaction();
              try {
                $sql = 'DELETE FROM post WHERE id = :id';
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':id',$brog['id'],PDO::PARAM_INT);
                $sth->execute();
                $this->dbh->commit();
              } catch (PDOException $e) {
                $this->dbh->rollBack();
                  echo $e->getMessage();
                  exit();
              }
            }
            /**
              *postテーブル更新機能
              *
              * @param integer $brog
              *@return Array $return
              */
              public function UP_date_post($brog){
                $this->dbh->beginTransaction();
                try {
                  $sql = 'UPDATE post
                          SET img = :img, name = :name, dog_id = :dog_id , parsonality_id = :parsonality_id , traning_id = :traning_id , body = :body
                          WHERE id = :id';
                  $sth = $this->dbh->prepare($sql);
                  $sth->bindParam(':img',$brog["img"],PDO::PARAM_STR);
                  $sth->bindParam(':name',$brog["name"],PDO::PARAM_STR);
                  $sth->bindParam(':dog_id',$brog["dog1"],PDO::PARAM_INT);
                  $sth->bindParam(':parsonality_id',$brog["parsonality"],PDO::PARAM_INT);
                  $sth->bindParam(':traning_id',$brog["traning"],PDO::PARAM_INT);
                  $sth->bindParam(':body',$brog["body"],PDO::PARAM_STR);
                  $sth->bindParam(':id',$brog["id"],PDO::PARAM_INT);
                  $sth->execute();
                  $this->dbh->commit();
                } catch (PDOException $e) {
                  $this->dbh->rollBack();
                  echo $e->getMessage();
                  exit();
                }
              }
              /**
                *postテーブルの決められたデータ取得
                *
                * @param integer
                *@return Array $return
                */
              public function get_post_limit(){
                $sql = "SELECT p.created_at,p.img,p.id,t.name AS traning FROM post p JOIN traning t ON t.id = p.traning_id ORDER BY created_at DESC LIMIT 3";
                $sth = $this->dbh->prepare($sql);
                $sth->execute();
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $result;
              }
              /**
                *questionテーブルの決められたデータ取得
                *
                * @param integer $brog
                *@return Array $return
                */
                public function fetch_question(){
                  $sql = 'SELECT u.name,q.id,q.email,q.body,q.created_at,t.name AS traning
                          FROM questions q
                          JOIN traning t ON t.id = q.traning_id
                          JOIN user u ON u.id = q.name_id';
                  $sth = $this->dbh->prepare($sql);
                  $sth->execute();
                  $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                  return $result;
                }
              /**
                *questionテーブルの決められたデータ取得
                *
                * @param integer $brog
                *@return Array $return
                */
              public function fetch_question_user($id){
                $sql = 'SELECT q.id,q.email,q.body,q.created_at,t.name AS traning,u.name
                        FROM questions q
                        JOIN traning t ON t.id = q.traning_id
                        JOIN user u ON u.id = q.name_id
                        WHERE u.id = :id';
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':id',$id,PDO::PARAM_INT);
                $sth->execute();
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $result;
              }
              /**
                *questionテーブルの中の決められたidのデータ取得
                *
                * @param integer
                *@return Array $return
                */
              public function fetch_question_id($get){
                $sql = 'SELECT u.name,q.email,q.body,t.name AS traning FROM questions q
                        JOIN traning t ON t.id = q.traning_id
                        JOIN user u ON u.id = q.name_id
                        WHERE q.id = :id';
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':id',$get['id'],PDO::PARAM_INT);
                $sth->execute();
                $result = $sth->fetch(PDO::FETCH_ASSOC);
                return $result;
              }
              /**
                *questionテーブルの登録が3番目のデータ取得
                *
                * @param integer
                *@return Array $return
                */
              public function fetch_post_question(){
                $sql = 'SELECT q.id,u.name,q.email,q.body,q.created_at,t.name AS traning_name
                        FROM questions q 
                        JOIN traning t ON t.id = q.traning_id
                        JOIN user u ON u.id = q.name_id
                        ORDER BY created_at DESC LIMIT 3';
                $sth = $this->dbh->prepare($sql);
                $sth->execute();
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $result;
              }
              /**
                *likeテーブルから取得
                *
                * @param integer
                *@return Array $like
                */
                function check_like_duplicate($user_id, $post_id){

                $sql = " SELECT * FROM `likes` WHERE user_id = :user_id AND post_id = :post_id";
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $sth->bindParam(':post_id', $post_id, PDO::PARAM_INT);
                $sth->execute();
                $like = $sth->fetch(PDO::FETCH_ASSOC);
                return $like;
            }
            /**
                *登録済みのlike削除
                *
                * @param integer
                *@return Array $return
                */
            function clearLike($user_id, $post_id){

                $sql = " DELETE FROM `likes` WHERE :user_id = user_id AND :post_id = post_id ";
                $this->dbh->beginTransaction();
              try {
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                $sth->bindParam(':post_id', $post_id, PDO::PARAM_INT);
                $sth->execute();
                $this->dbh->commit();
              } catch (PDOException $e) {
                $this->dbh->rollBack();
                echo $e->getMessage();
                exit();
              }
            }
            /**
                *like登録
                *
                * @param integer
                *@return Array $return
                */
            function registerLike($user_id, $post_id){
              $sql =" INSERT INTO `likes`( post_id, user_id )
                      VALUE ( :post_id, :user_id ) ";
              $this->dbh->beginTransaction();
              try {
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':user_id', $user_id, PDO::PARAM_STR);
                $sth->bindParam(':post_id', $post_id, PDO::PARAM_STR);
                $sth->execute();
                $this->dbh->commit();
              } catch (PDOException $e) {
                $this->dbh->rollBack();
                echo $e->getMessage();
                exit();
              }
            }
            /**
                *likeのテーブルを数える
                *
                * @param 
                *@return Array $return
                */
            public function fetch_like_count($id){
              $sql = 'SELECT count(user_id) AS like_count FROM likes WHERE post_id = :post_id';
              $sth = $this->dbh->prepare($sql);
              $sth->bindParam(':post_id', $id, PDO::PARAM_INT);
              $sth->execute();
              $return = $sth->fetch();
              return $return;
            }
            /**
              *いいねされているpostテーブルの数を出す
              *
              * @param $page = 0
              *@return Array $return
              */
            public function fetch_like_user($page = 0){
              $sql = 'SELECT p.id,p.img,p.name,p.name,p.dog_id,p.parsonality_id,p.traning_id,p.body,p.created_at,COUNT(l.user_id) AS count,d.name AS dog_name,t.name AS traning_name,p1.name AS parsonality_name
                      FROM post p
                      JOIN likes l ON l.post_id = p.id
                      JOIN dog d ON d.id = p.dog_id
                      JOIN parsonality p1 ON p1.id = p.parsonality_id
                      JOIN traning t ON t.id = p.traning_id
                      GROUP BY p.id
                      ORDER BY count DESC';
              $sql .=' LIMIT 6 OFFSET '.(6*$page);
              $sth = $this->dbh->prepare($sql);
              $sth->execute();
              $return = $sth->fetchAll(PDO::FETCH_ASSOC);
              return $return;
            }
            /**
              *likeのページング機能
              *
              *@param integer
              *@return Array $count
              */
              public function countLike():Int{
                $sql = 'SELECT count(*) as count FROM post p
                        JOIN likes l ON l.post_id = p.id 
                        GROUP BY p.id
                        ORDER BY count DESC';
                $sth = $this->dbh->prepare($sql);
                $sth->execute();
                $count = $sth->fetchColumn();
                return $count;
              }
              /**
              *commentテーブルに追加機能
              *
              *@param $brog
              *@return Array 
              */
              public function comment($brog){
                $sql = 'INSERT INTO post_comment(user_id,post_id,comment)
                        VALUES (:user_id,:post_id,:comment)'; 
                $this->dbh->beginTransaction();
                try {
                  $sth = $this->dbh->prepare($sql);
                  $sth->bindParam(':user_id',$brog['user_id'],PDO::PARAM_INT);
                  $sth->bindParam(':post_id',$brog['post_id'],PDO::PARAM_INT);
                  $sth->bindParam(':comment',$brog['post_comment'],PDO::PARAM_STR);
                  $comment = $sth->execute();
                  $this->dbh->commit();
                } catch (PDOException $e) {
                  $this->dbh->rollBack();
                  echo $e->getMessage();
                  exit();
                }
              }
              /**
              *commentテーブルの値を取る
              *
              *@param $brog
              *@return Array 
              */
              public function fetch_comment($brog){
                $sql = 'SELECT p.comment AS comment,p.id AS id,u.name AS name,`created.at`
                        FROM post_comment p
                        JOIN user u ON u.id = p.user_id
                        JOIN post p1 ON p.post_id = p1.id
                        WHERE p.id = (SELECT MAX(id) FROM post_comment) &&
                        u.id = :id1 && p1.id =:id';
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':id1',$brog['user_id'],PDO::PARAM_INT);
                $sth->bindParam(':id',$brog['post_id'],PDO::PARAM_INT);
                $sth->execute();
                $result = $sth->fetch(PDO::FETCH_ASSOC);
                return $result;
              }
              /**
              *commentテーブルの値を取る
              *
              *@param $brog
              *@return Array 
              */
              public function fetch_commentAll($id){
                $sql = 'SELECT p.comment AS comment,u.name AS name ,u.id AS id,`created.at`
                        FROM post_comment p
                        JOIN user u ON u.id = p.user_id
                        JOIN post p1 ON p.post_id = p1.id
                        WHERE p.post_id = :id
                        ORDER BY `created.at` DESC';
                $sth = $this->dbh->prepare($sql);
                $sth->bindParam(':id',$id,PDO::PARAM_INT);
                $sth->execute();
                $result = $sth->fetchAll(PDO::FETCH_ASSOC);
                return $result;
              }
}
?>
