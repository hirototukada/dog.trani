<?php
if (empty($_SERVER["HTTP_REFERER"])) {
  header('Location: ../login/login.php');
}
$dog_modal = $Dog_post->Get_dog_date();
$parsonality_modal = $Dog_post->Get_parsonality_date();
$traning_modal = $Dog_post->Get_traning_date();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <mate charset="UTF-8">
    <title>検索画面</title>
 </head>

     <!-- ボタン・リンククリック後に表示される画面の内容 -->
     <div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">
                 <div class="modal-header">
                     <h4 class = "green-text">検索</h4>
                 </div>
                 <div class="modal-body">
                     <!-- <label>データを削除しますか？</label> -->
                     <?php if ($_SESSION['role'] == 1): ?>
                       <form action="/animal/mypage/list.php" method="GET">
                     <?php elseif ($_SESSION['role'] == 2): ?>
                       <form action="/animal/manage/list1.php" method="GET">
                     <?php endif; ?>
                          <div class="mt-4">
                          <label class="w-25">犬種：</label>
                          <select name="dog">
                            <option value="">選択してください</option>
                            <?php for ($i=0; $i < count($dog_modal); $i++):?>
                            <option value="<?=$dog_modal[$i]['id']?>"><?=$dog_modal[$i]['name']?></option>
                            <?php endfor; ?>
                          </select>
                          </div>
                          <div class="mt-4">
                          <label class="w-25">性格：</label>
                          <select name="parsonality">
                            <option value="">選択してください</option>
                            <?php for ($i=0; $i < count($parsonality_modal); $i++):?>
                            <option value="<?=$parsonality_modal[$i]['id']?>"><?=$parsonality_modal[$i]['name']?></option>
                            <?php endfor; ?>
                          </select>
                        </div>
                        <div class="mt-4">
                          <label class="w-25">トレーニング：</label>
                          <select name="traning">
                            <option value="">選択してください</option>
                            <?php for ($i=0; $i < count($traning_modal); $i++):?>
                            <option value="<?=$traning_modal[$i]['id']?>"><?=$traning_modal[$i]['name']?></option>
                            <?php endfor; ?>
                          </select>
                        </div>
                        <div class="mt-4">
                          <label class="w-25">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>検索ワード：
                          </label>
                          <input type="text" name="search" value="">
                        </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="green-text bg-white border-g" data-dismiss="modal">閉じる</button>
                     <button type="submit" class="green text-white border-0">
                       <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                         <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                       </svg>検索
                     </button>
                 </div>
                 </form>
             </div>
         </div>
     </div>
