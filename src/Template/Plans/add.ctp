<?= $this->Html->script('event_add') ?>
<?php $this->assign('title', '候補日追加'); ?>


<div class="planBox">
  <h1 class="center-align sp-h1">候補日追加</h1>
    <?=$this->Form->create()?>

    <div class="row">
      <div class="input-field col s6">
        <input id="date-start" class="form-control" name="start_day" value="" type="text">
        <label class="active2">開始日</label>
      </div>
      <div class="input-field col s6">
        <input id="time-start" class="form-control" name="start_time" value="" type="time">
        <label class="active2">開始時間</label>
      </div>
      <div class="input-field col s6">
        <input id="date-end" class="form-control" name="end_day" value="" type="text">
        <label class="active2">終了日</label>
      </div>
      <div class="input-field col s6">
        <input id="time-end" class="form-control" name="end_time" value="" type="time">
        <label class="active2">終了時間</label>
      </div>
      <div class="input-field col s12">
        <?= $this->Form->input('title', array(
          'label' => array(
            'text' => ''
          ),
          'id' => 'title',
          'div' => false,
          'class' => 'validate',
          'value' => ''
        )); ?>
        <label class="active">メモ</label>
      </div>
  </div>
  <div id="created_event"></div>
  <div class="right-align btns">
      <a href="<?= $this->Url->build(['controller' => 'Plans', 'action' => 'detail', $plan_id]); ?>" class="btn back2-btn">
      戻る</a>
      <?=$this->Form->submit('追加',['class' => 'btn','id' => 'submit']); ?>
      <?=$this->Form->end() ?>
  </div>
</div>
