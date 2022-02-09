<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: ../login/login.php');
  }
session_start();
require_once(ROOT_PATH .'/Controllers/PlayerController.php');
require_once(ROOT_PATH .'/Controllers/Dog_likeController.php');
$like = new LikeController();
$player = new PlayerController();
$id = $_GET;
$brog = $player->get_post_Date($id['id']);
$dog = $player->get_name($brog['dog_id'],$brog['parsonality_id'],$brog['traning_id']);
$user_id = $_SESSION['id'];
$post_id = $id['id'];
$likes = $like->like_Count($post_id);
$commentAll = $player->fetchCommentAll($post_id);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>投稿詳細画面</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/css/like.css">
</head>
<body>
  <?php if ($_SESSION['role'] == 1): ?>
    <header><?php include '../Views/animal/include/header1.php';?></header>
  <?php elseif ($_SESSION['role'] == 2): ?>
    <header><?php include '../Views/animal/include/header2.php';?></header>
  <?php endif; ?>
<main>
       <div class="container mt-3">
           <div class="row">
               <div class="col-6">
                  <h2 class="green-text">詳細</h2>
               </div>
           </div>
       </div>
       <div class="container mt-3 py-2 pb-5">
           <div class="row">
               <div class="col-6">
                   <div class="card width-100">
                   <img class="card-img-top" style="height: 500px; width: 100%; display: block;" src="<?=$brog['img'];?>" data-holder-rendered="true" name='img'>
                   </div>
                   <div class="coordinateContents mx-auto my-auto">
                       <label for="body" class="form-label">わんちゃんの名前</label>
                       <dd class="form-control" id="body" rows="8" name="name" readonly><?=$brog['name']?></dd>
                   </div>
               </div>
               <div class="col-6">
                   <label for="body" class="form-label">
                       犬種名
                   </label>
                       <dd class="form-control" aria-label="Sizing example input" name="dog" aria-describedby="inputGroup-sizing-default" readonly><?=$dog['dog']['name']?></dd>
                   <label for="body" class="form-label">
                       トレーニング
                   </label>
                       <dd class="form-control" aria-label="Sizing example input" name="traning" aria-describedby="inputGroup-sizing-default" readonly><?=$dog['traning']['name']?></dd>
                   <label for="body" class="form-label">
                       性格
                   </label>
                       <dd class="form-control" aria-label="Sizing example input" name="parsonality" aria-describedby="inputGroup-sizing-default" readonly><?=$dog['parsonality']['name']?></dd>
                   <label for="body" class="form-label">
                       投稿内容
                   </label>
                   <textarea class="form-control bg-white" id="exampleFormControlTextarea1" rows="9" name="body" readonly><?=$brog['body']?></textarea>
                <div class="mt-5 d-flex justify-content-around">
                  <?php if ($_SESSION['role'] == 1): ?>
                    <button type="button"class="btn btn-outline-secondary" onclick="history.back()">戻る</button>
                    <section class="post" data-postid="<?=$post_id ?>" data-userid="<?=$user_id?>">
                              <div class="like_btn <?php if (!$like->like($user_id,$post_id)){echo 'active';} ?>">
                              <!-- 自分がいいねした投稿にはハートのスタイルを常に保持する -->
                              <i class="a fa-heart fa-lg px-24
                              <?php
                              if($like->like($user_id,$post_id)){ //いいね押したらハートが塗りつぶされる
                                  echo ' active fas';
                              }else{ //いいねを取り消したらハートのスタイルが取り消される
                                  echo ' far';
                              }; ?>"></i>
                              いいね！<span class = "like">
                                        <?=$likes["like_count"]?>'
                                    </span>
                          </section>
                    </button>
                  <?php elseif ($_SESSION['role'] == 2): ?>
                    <button type="button" class="p-2 bg-white border-g green-text w-25"><a class="green-g-under green-text" href="../manage/my_form.php?id=<?=$brog['id'] ?>">編集</a></button>
                    <button type="button" class="p-2 green text-white border-0 w-25"><a class="green-g-under text-white" href="../manage/delete.php?id=<?=$brog['id'] ?>" onclick="return confirm('削除します。よろしいですか？')">削除</a></button>
                  <?php endif; ?>
                </div>
              </div>
           </div>
       </div>
   </main>
   <script>
   $(function(){
    if ($('.a').hasClass('far')) {
        var count1 = "<?=$likes["like_count"]+1?>";
        var count2 = "<?=$likes["like_count"]?>";
    }else if($('.a').hasClass('fas')){
        var count1 = "<?=$likes["like_count"]?>";
        var count2 = "<?=$likes["like_count"]-1?>";
    }

       $('.like_btn').on('click',function(e){
           e.stopPropagation();
           var $this = $(this);
           //カスタム属性（postid）に格納された投稿ID取得
           goodPostId = $this.parents('.post').data('postid');
           goodUserId = $this.parents('.post').data('userid');
           $.ajax({
               type: 'POST',
               url: 'ajaxGood.php',
               dataType: 'text', //post送信を受けとるphpファイル
               data: { postId: goodPostId,
                       userId: goodUserId}, //{キー:投稿ID}
           }).done(function(data){
               console.log(goodUserId);
               console.log(goodPostId);
               // いいねの総数を表示
            //    $this.children('.like').toggle();
                if ($('.a').hasClass('far')) {
                    $this.children('.like').text(count1);
                }else if($('.a').hasClass('fas')){
                    $this.children('.like').text(count2);
                }
                
               // いいね取り消しのスタイル
               $this.children('i').toggleClass('far'); //空洞ハート
               // いいね押した時のスタイル
               $this.children('i').toggleClass('fas'); //塗りつぶしハート
               $this.children('i').toggleClass('active');
               $this.toggleClass('active');
           }).fail(function(msg) {
               console.log('Ajax Error');
           });
       });
   });
   </script>

<?php include 'ajax.php';?>
</html>
