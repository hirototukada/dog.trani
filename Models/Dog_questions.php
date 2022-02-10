<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Dog_questions extends Db{
    private $table = 'questions';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }
    /**
      *questionsテーブルにデータを追加
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
}