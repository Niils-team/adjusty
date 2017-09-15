<?php
$this->assign('title', 'ホーム');
 ?>

 <?=$this->Html->script('top_calendar') ?>

<div class="adjusty-extended-nav">
  <div class="container">
    <div class="row">
      <div class="col s6"><a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'list']); ?>">調整リスト
      </div>
      <div class="col s6"><a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'calendar']); ?>" class="indicator">カレンダー</a></div>
    </div>
  </div>
</div>

<div class="topBox">
  <div id='calendar'></div>
</div>

<div class="fixed-action-btn">
  <a href="<?php echo $this->Url->build(['controller'=>'Events', 'action'=>'create']); ?>" class="btn-floating btn-large waves-effect waves-light red">
    <i class="material-icons">add</i>
  </a>
</div>
