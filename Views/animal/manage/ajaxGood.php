<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: ../login/login.php');
  }
require_once(ROOT_PATH .'/Controllers/Dog_likeController.php');
$like = new LikeController();
$user_id = $_POST['userId'];
$post_id = $_POST['postId'];
$return = $like->like($user_id,$post_id);
?>
