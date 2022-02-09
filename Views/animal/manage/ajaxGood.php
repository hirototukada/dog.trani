<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: ../login/login.php');
  }
require_once(ROOT_PATH .'Controllers/PlayerController.php');
$user_id = $_POST['userId'];
$post_id = $_POST['postId'];
$player = new PlayerController();
$return = $player->like($user_id,$post_id);
?>
