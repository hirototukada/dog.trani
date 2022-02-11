<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Dog_like extends Db{
    private $table = 'likes';
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }
    /**
     *likeテーブルから取得
    *
    * @param integer
    *@return Array $like
    */
    function check_like_duplicate($user_id, $post_id){

        $sql = " SELECT * FROM $this->table WHERE user_id = :user_id AND post_id = :post_id";
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

        $sql = " DELETE FROM $this->table WHERE :user_id = user_id AND :post_id = post_id ";
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
        $sql =" INSERT INTO $this->table( post_id, user_id )
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
        $sql = "SELECT count(user_id) AS like_count FROM $this->table WHERE post_id = :post_id";
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
        $sql = "SELECT count(*) as count FROM post p
                JOIN $this->table l ON l.post_id = p.id 
                GROUP BY p.id
                ORDER BY count DESC";
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $count = $sth->fetchColumn();
        return $count;
    }    
}
?>