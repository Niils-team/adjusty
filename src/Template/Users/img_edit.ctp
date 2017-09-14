<?php
$this->assign('title', '画像の編集');
?>
<div class="mypageBox">

  <div class="row">

  <h5 class="event-step">カバー画像変更</h5>
  <div class="mypageBack">
    <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 2]); ?> " class="responsive-img"/><br>
  </div>
    <?php echo $this->Form->create(null, array('enctype' => 'multipart/form-data')); ?>

    <div class="center-align m-t-20">
      <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "imgDelete", 2]); ?>" class="btn delete-btn" role="button">削除する</a>
      <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "coverImgEdet"]); ?>" class="btn uplode-btn" role="button">カバー画像の変更</a>
    </div>
  </div>


  <div class="row">

  <h5 class="event-step">プロフィール画像変更</h5>
    <div class="p-imgBox">
      <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?> " class="responsive-img circle" /><br>
    </div>
    <?php echo $this->Form->create(null, array('enctype' => 'multipart/form-data')); ?>

    <div class="center-align">
      <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "imgDelete", 1]); ?>" class="btn delete-btn" role="button">削除する</a>
      <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "mainImgEdet"]); ?>" class="btn uplode-btn" role="button">メイン画像の変更</a>
    </div>

  </div>

    <a href="<?php echo $this->Url->build(['controller'=>'Users', 'action'=>'profile']); ?>" class="btn back-btn">
     <i class="small left material-icons">arrow_back</i>プロフィール画面に戻る
    </a>

</div>
