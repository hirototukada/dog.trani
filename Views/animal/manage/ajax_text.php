<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: ../login/login.php');
  }
header("Content-type: application/json; charset=UTF-8");
require_once(ROOT_PATH .'Controllers/PlayerController.php');
$comment = new PlayerController();
$brog = $_POST;
$comment->commentPost($brog);
$comment_json = $comment->fetchComment($brog);
$userData[]=array(
    'id'=>$comment_json['id'],
    'comment'=>$comment_json['comment'],
    'created' =>$comment_json['created.at'],
    );
echo json_encode($userData);
?>