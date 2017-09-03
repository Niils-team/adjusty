<?php
$this->assign('title', 'ホーム');
 ?>

 <?=$this->Html->script('top_calendar') ?>

<div class="adjusty-extended-nav">
  <div class="container">
    <div class="row">
      <!-- 調整中案件があれば件数とともに表示 -->
      <div class="col s6"><a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'list']); ?>">調整リスト
      
      <?php if ($plan_fix_cnt != 0): ?>
        <span class="badge red"><?php echo $plan_fix_cnt ?></span>
      <?php endif ?>

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
