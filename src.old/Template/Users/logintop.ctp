<?php $this->assign('title', 'ホーム'); ?>
<div class="topBox">
  <div class="center-align">
    <?php echo $this->Html->link('新規予定作成', ['controller'=>'Events', 'action'=>'create'], ['class' => 'waves-effect waves-light btn']); ?>
    <?php echo $this->Html->link('予定の修正・確認', ['controller'=>'Events', 'action'=>'edit'], ['class' => 'waves-effect waves-light btn']); ?>
  </div>

  <div class="topBox-list">
    <ul>
      <li><i class="small left material-icons">help_outline</i><?php echo $this->Html->link('使い方', ['controller'=>'Users', 'action'=>'mypage']); ?></li>
      <li class="hide-on-large-only"><i class="small left material-icons">portrait</i><?php echo $this->Html->link('マイページ', ['controller'=>'Users', 'action'=>'mypage']); ?></li>
      <li class="hide-on-large-only"><i class="small left material-icons">settings</i><?php echo $this->Html->link('設定', ['controller'=>'Users', 'action'=>'setting']); ?></li>
    </ul>
  </div>

</div>
