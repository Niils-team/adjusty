<?php $this->assign('title', 'ホーム'); ?>
<li><a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'top']); ?>">リスト表示</a></li>
<li><a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'calendar']); ?>">カレンダー表示</a></li>
<?php if ($plan_cnt == 0): ?>
  <div class="planBox">
    <div class="noplan">
      <p class="center-align">予定はまだありません。</p>
    </div>
  </div>


<?php else: ?>
  <!-- プランがあった場合 -->

<div class="planBox">
  <div class="has-plans">
    <ul class="collection collapsible" data-collapsible="accordion">

      <?php foreach ($plans as $plan):?>
      <li>
        <div class="collapsible-header collection-item avatar">
          <!-- <?php echo $this->Html->image('ic_work.png', ['class' => 'circle']); ?> -->
          <i class="material-icons circle">folder</i>
          <span class="title"><?php echo $plan['title']; ?></span>
          <p>作成日：<?php echo date('Y-m-d H:m', strtotime($plan['created'])); ?></p>
          <a href="#!" class="secondary-content"><i class="material-icons">keyboard_arrow_down</i></a>
        </div>
        <div class="collapsible-body">

        <p>
          <?php

            // echo $plan['events'][$i]['title'];
             $cnt = count($plan['events'])-1;
            // echo $cnt;



            for ($i = 0; $i <= $cnt; $i++) {

          ?>
          <?php echo date('Y', strtotime($plan['events'][$i]['start'])); ?>年<?php echo date('m', strtotime($plan['events'][$i]['start'])); ?>月<?php echo date('d', strtotime($plan['events'][$i]['start'])); ?>日
          <?php
            if ($plan['events'][$i]['allDay'] == 1) {
              echo '終日';
            } else {
              echo date('H:i', strtotime($plan['events'][$i]['start'])).'〜'.date('H:i', strtotime($plan['events'][$i]['end']));
            }

            ;
            echo '&nbsp;';
            // echo $plan['events'][$i]['title'];
            if ($plan['events'][$i]['fixed_flag'] == 1) {
              # 確定の場合
              echo '&nbsp;';
              echo '<span class="teal-text"><i class="tiny material-icons">fiber_manual_record</i></span>';
              echo '&nbsp;';
              echo $plan['events'][$i]['guest_name'];
              echo '<br>';
            } else {
              # 未確定の場合
              echo '&nbsp;';
              echo '<span class="grey-text text-lighten-1"><i class="tiny material-icons">fiber_manual_record</i></span>';
              echo '未確定';
              echo '<br>';
            }



            }
          ?>
        </p>

          <div class="right-align planlists-inner">
            <?= $this->Form->end() ?>
            <?= $this->Form->postLink(__('詳細を確認'), ['action' => 'detail', $plan['id']], ['class' => 'waves-effect waves-light btn']) ?>
            <?= $this->Form->postLink(__('予定を削除'), ['action' => 'delete', $plan['id']], ['class' => 'btn delete-btn','confirm' => __('この予定を全て削除してもよろしいですか？', $plan['id'])]) ?>
          </div>

        </div>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>

<?php endif; ?>


  <div class="fixed-action-btn">
    <a href="<?php echo $this->Url->build(['controller'=>'Events', 'action'=>'create']); ?>" class="btn-floating btn-large waves-effect waves-light red">
      <i class="material-icons">add</i>
    </a>
  </div>
</div>
