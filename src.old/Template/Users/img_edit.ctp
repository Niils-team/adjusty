<?php
$this->assign('title', '画像の編集');
?>
<div class="mypageBox">

  <div class="row">

  <h5 class="white-text grey darken-1 event-step">カバー画像変更</h5>
  <div class="mypageBack" id="img-container">
    <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 2]); ?> " class="responsive-img"/><br>
  </div>
    <?php echo $this->Form->create(null, array('enctype' => 'multipart/form-data')); ?>
    <div class="file-field input-field">
      <div class="btn">
        <span>画像を選択</span>
        <?php echo $this->Form->file('image'); ?>
      </div>
      <div class="file-path-wrapper">
        <?php echo $this->Form->hidden('img_no' ,array('value' => '2')); ?>
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="center-align">
      <?php echo $this->Form->submit('アップロード', ['class' => 'btn upload-btn']); ?>

      <?php echo $this->Form->end(); ?>
      <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "imgDelete", 2]); ?>" class="btn delete-btn" role="button">削除する</a>
    </div>
  </div>


  <div class="row">

  <h5 class="white-text grey darken-1 event-step">プロフィール画像変更</h5>
    <div class="p-imgBox">
      <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?> " class="responsive-img circle" /><br>
    </div>
    <?php echo $this->Form->create(null, array('enctype' => 'multipart/form-data')); ?>
    <div class="file-field input-field">
      <div class="btn">
        <span>画像を選択</span>
        <?php echo $this->Form->file('image'); ?>
      </div>
      <div class="file-path-wrapper">
        <?php echo $this->Form->hidden('img_no' ,array('value' => '1')); ?>
        <input class="file-path validate" type="text">
      </div>
    </div>
    <div class="center-align">

      <?php echo $this->Form->submit('アップロード', ['class' => 'btn upload-btn']); ?>
      <?php echo $this->Form->end(); ?>
      <a href="<?php echo $this->Url->build(["controller" => "Users", "action" => "imgDelete", 1]); ?>" class="btn delete-btn" role="button">削除する</a>
    </div>

  </div>

    <a href="<?php echo $this->Url->build(['controller'=>'Users', 'action'=>'profile']); ?>" class="btn back-btn">
     <i class="small left material-icons">arrow_back</i>プロフィール画面に戻る
    </a>

</div>
