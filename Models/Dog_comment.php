<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Comment extends Db{
    private $table = 'post_comment';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }
    /**
      *commentテーブルに追加機能
      *
      *@param $brog
      *@return Array 
      */
    public function comment($brog){
        $sql = "INSERT INTO $this->table(user_id,post_id,comment)
                VALUES (:user_id,:post_id,:comment)"; 
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