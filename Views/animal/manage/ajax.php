<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: ../login/login.php');
  }
?>

<div class = 'm-auto w-75'>
    <h2>コメント</h2>
      <div id='t'></div>
    <textarea type="text" class = 'textarea-come p-3 w-75 h-25' id="comment" name="name" placeholder="ここにコメントを記載"></textarea>
    <div class = 'w-75 text-end'><button id="add-order" class = 'mt-3 text-center btn-primary w-25' type = 'submit'>送信</button></div?>
</div>

<h1 class="my-5 text-dark">コメント一覧</h1>
<div class="container comment1">
    <?php for($i = 0; $i < count($commentAll); $i++):?>
    <div class="card mb-3">
      <div class="card-body">
        <h5 class="card-title"><?=$commentAll[$i]['name']?></h5>
        <p class="card-text come"><?=$commentAll[$i]['comment']?></p>
        <p class="card-text time text-end"><?=$commentAll[$i]['created.at']?></p>
      </div>
    </div>
    <?php endfor;?>
  </div>




  <script>
 
 $(function(){



    $('#add-order').on('click',function(){//id add-orderがクリックされたら以下の関数を実行してね、と記述
        var comment = $('#comment').val(); //inputタグのname追加

        if ($('#comment').val() == "") {
            var user_name = "";
        }else{
            var user_name    = '<?=$_SESSION['name']?>さん';
            var user_comment_id      = '<?=$_SESSION['id']?>';
            var user_post_id      = <?=$post_id?>;
        }
        if (!$('#comment').val() == "") {
            $.ajax({
                    type: 'POST',
                    url: 'ajax_text.php',
                    dataType: 'text', //post送信を受けとるphpファイル
                    data: { post_comment: comment,
                            user_id  : user_comment_id,
                            post_id :user_post_id,
                            name : user_name}, //{キー:投稿ID}
                }).done(function(data){
                    const json = JSON.parse(data);
                    console.log(json);
                    var string =    '<div class="card mb-3">'+
                                    '<div class="card-body">'+
                                    '<h5 class="card-title">'+user_name+'</h5>'+
                                    '<p class="card-text come">'+json[0].comment+'</p>'+
                                    '<p class="card-text time text-end">'+json[0].created+'</p>'+
                                    '</div></div>';

                    $('.comment1').prepend(string);
                    $('.textarea-come').val('');
                }).fail(function(msg) {
                    console.log('Ajax Error');
                });
        }
    });
});

</script>

