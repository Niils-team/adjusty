<?php $this->assign('title', 'ホーム'); ?>
<div class="adjusty-extended-nav">
  <div class="container">
    <div class="row">
      <!-- 依頼を受けた＆未読の案件があれば件数とともに表示 -->
      <div class="col s6"><a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'list']); ?>" class="indicator">調整リスト<span class="badge red">4</span></a></div>
      <div class="col s6"><a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'calendar']); ?>">カレンダー</a></div>
    </div>
  </div>
</div>
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
    <div class="row statusBox">
      <div class="col s4">
        <i class="tiny material-icons blue-text deg-x-180">trending_flat</i> 依頼した予定<br>
        <i class="tiny material-icons red-text">trending_flat</i> 依頼された予定
      </div>
      <div class="col s8">
        <div class="right">
          <a href="#">すべて</a> | <a href="#">調整中</a> | <a href="#">確定済</a>
        </div>
      </div>
    </div>
    <ul class="collection collapsible statusList" data-collapsible="accordion">

      <?php foreach ($plans as $plan):?>
      <li>
        <div class="collapsible-header collection-item avatar">
          <i class="tiny material-icons blue-text deg-x-180 plan_arrow">trending_flat</i>
          <?php echo $this->Html->image('a_icon.png', ['class' => 'circle']); ?>
          <!-- <i class="material-icons circle">folder</i> -->
          <span class="title"><?php echo $plan['title']; ?></span>
          <p class="pushedtime">作成日時：<?php echo date('Y-m-d H:m', strtotime($plan['created'])); ?></p>
          <span class="adjusty-status"><i class="tiny material-icons red-text">lens</i>調整中</span>
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
