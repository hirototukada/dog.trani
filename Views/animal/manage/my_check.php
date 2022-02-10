<?php
if (empty($_SERVER["HTTP_REFERER"])) {
    header('Location: ../login/login.php');
  }
session_start();
include '../Views/animal/include/header2.php';
$file =$_FILES;
$brog = $_POST;
$validation->FormValdation($brog);
$validation->ImgValidation($file);
$filename = basename($file['img']['name']);
$save_filename = date('YmbHis').$filename;
$upload_dir = 'UPload/';
$upload_file = $upload_dir.$save_filename;
move_uploaded_file($file['img']['tmp_name'],$upload_file);
$dog1 = $brog['dog'];
$traning = $brog['traning'];
$parsonality = $brog['parsonality'];
$dog = $Dog_post->get_name($dog1,$parsonality,$traning);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>投稿確認画面</title>
</head>
<body>
  <form action="my_up.php" method="post">
  <div class="container mt-3 py-2 pb-5">
      <div class="row">
          <div class="col-6">
              <div class="card width-100">
                <input type="hidden" name="img" value = "<?php echo "/".$upload_file;?>">
              <img class="card-img-top" style="height: 500px; width: 100%; display: block;" src="<?php echo "/".$upload_file;?>" data-holder-rendered="true" name='img'>
              </div>
              <div class="coordinateContents mx-auto my-auto">
                 <input type="hidden" name="name" value = "<?=$brog['name']?>">
                  <label for="body" class="form-label">わんちゃんの名前</label>
                  <dd class="form-control" id="body" rows="8" readonly><?=$brog['name']?></dd>
              </div>
          </div>
          <div class="col-6">
              <label for="body" class="form-label">
                  犬種名
              </label>
                 <input type="hidden" name="dog1" value = "<?=$dog1?>">
                  <dd class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly><?=$dog['dog']['name']?></dd>
              <label for="body" class="form-label">
                  トレーニング
              </label>
                   <input type="hidden" name="traning" value = "<?=$traning?>">
                  <dd class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly><?=$dog['traning']['name']?></dd>
              <label for="body" class="form-label">
                  性格
              </label>
              <input type="hidden" name="parsonality" value = "<?=$parsonality?>">
                  <dd class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly><?=$dog['parsonality']['name']?></dd>
              <label for="body" class="form-label">
                  投稿内容
              </label>
              <input type="hidden" name="id" value="<?=$brog['id']?>">
              <input type="hidden" name="body" value = "<?=$brog['body']?>">
              <textarea class="form-control bg-white" id="exampleFormControlTextarea1" rows="9" readonly><?=$brog['body']?></textarea>
           <div class="mt-5 text-end">
             <button type="button" class="p-2 bg-white border-g green-text w-25" name="button" onclick="history.back()">戻る</button>
             <button type="submit" class="p-2 green text-white border-0 w-25">更新</button>
           </div>
         </div>
      </div>
  </div>
  </form>

</body>
</html>
