<?= $this->Html->script('event_edit') ?>

<div class="planBox">
  <h1 class="center-align sp-h1">候補日編集</h1>
  <div class="planlists">
    <div class="row planlists-item z-depth-2">
      <div class="row">
        <div class="input-field col s12">
        <?=$this->Form->create($event,['type' => 'post'])?>

        <p>開始日</p>
        <input id="date-start" class="form-control" name="start_day" value="<?php echo date('Y-m-d', strtotime($event['start'])); ?>" type="text">
        <p>開始時間</p>
        <input id="time-start" class="form-control" name="start_time" value="<?php echo date('H:i', strtotime($event['start'])); ?>" type="time">
        <p>終了日</p>
        <input id="date-end" class="form-control" name="end_day" value="<?php echo date('Y-m-d', strtotime($event['end'])); ?>" type="text">
        <p>終了時間</p>
        <input id="time-end" class="form-control" name="end_time" value="<?php echo date('H:i', strtotime($event['end'])); ?>" type="time">


        </div>
      <div class="row">
        <div class="input-field col s12">
          <?= $this->Form->input('title', array(
            'label' => array(
              'text' => ''
            ),
            'div' => false,
            'class' => 'validate',
            'value' => $event['memo']
          )); ?>
          <label class="active">メモ</label>
        </div>
      </div>
      </div>
      <div id="created_event"></div>
      <div class="right-align btns">
          <a href="<?= $this->Url->build(['controller' => 'Plans', 'action' => 'detail', $plan_id]); ?>" class="btn back2-btn">
          戻る</a>
          <?=$this->Form->submit('更新',['class' => 'btn']); ?>
          <?=$this->Form->end() ?>
      </div>
    </div>
  </div>
</div>
