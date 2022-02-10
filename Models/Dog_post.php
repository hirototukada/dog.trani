<?php
require_once(ROOT_PATH .'/Models/Db.php');

class dog_post extends Db{
    private $table = 'post';
    public function __construct($dbh = null){
        parent::__construct($dbh);
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
}
?>