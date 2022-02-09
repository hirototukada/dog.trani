<?php
require_once(ROOT_PATH .'/Models/Db.php');

class Dog_user extends Db{
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
}
?>