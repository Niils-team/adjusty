<?php $this->assign('title', 'ホーム'); ?>


<div class="adjusty-extended-nav">
  <div class="container">
    <div class="row">
      <!-- 依頼を受けた＆未読の案件があれば件数とともに表示 -->
      <div class="col s6"><a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'list']); ?>" class="indicator">調整リスト

      <?php if ($plan_fix_cnt != 0): ?>
        <span class="badge red"><?php echo $plan_fix_cnt ?></span>
      <?php endif ?>

      </a></div>
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
      <div class="col s6">
        <ul class="collection">
          <li class="collection-item"><i class="left tiny material-icons adjusty-text deg-x-180">call_made</i> 依頼した予定</li>
          <li class="collection-item"><i class="left tiny material-icons grey-text deg-x-180">call_received</i> 依頼された予定</li>
        </ul>
      </div>
      <div class="col s6">
        <div class="right">
          <div class="sort-links">

            <a href="<?php echo $this->Url->build(['action'=>'list']); ?>" class="activelink">すべて</a> |
            <a href="<?php echo $this->Url->build(['action'=>'list','adjusting']); ?>">調整中</a> |
            <a href="<?php echo $this->Url->build(['action'=>'list','fixed']); ?>">確定済</a>

          </div>
        </div>
      </div>
    </div>
    <ul class="collection collapsible statusList" data-collapsible="accordion">

      <?php foreach ($plans as $plan):?>

      <li>
        <div class="collapsible-header collection-item avatar">

        <?php if ($plan['user_id'] == $user['id']): ?>
          <i class="tiny material-icons adjusty-text deg-x-180 plan_arrow">call_made</i>
          <?php echo $this->Html->image('a_icon_white.png', ['class' => 'circle']); ?>
        <?php else: ?>
          <i class="tiny material-icons grey-text deg-x-180 plan_arrow">call_received</i>
          <img src="<?= $this->Url->build(["controller" => "Users", "action" => "drawOther", $plan->user_id ]); ?>" class="circle" />
        <?php endif ?>


          <!-- <i class="material-icons circle">folder</i> -->
          <span class="title"><?php echo $plan['title']; ?></span>
          <p class="pushedtime">作成日時：<?php echo date('Y-m-d H:m', strtotime($plan['created'])); ?></p>
          <?php if ($plan['target_id'] == $user['id']): ?>
              <p class="pushedtime">作成者：<?php echo $plan->user->name ?></p>
          <?php endif ?>

          <span class="adjusty-status">
            <div class="adjusty-status-inner">

              <?php if ($plan['is_fixed'] == 0): ?>
                <i class="tiny material-icons red-text">lens</i>
                <div class="adjusty-status-inner-right">調整中</div>
              <?php else: ?>
                <i class="tiny material-icons teal-text">lens</i>
                <div class="adjusty-status-inner-right">確定済</div>
              <?php endif ?>

            </div>
          </span>
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
            <?= $this->Form->postLink(__('予定を削除'), ['action' => 'delete', $plan['id']], ['class' => 'btn delete-btn','confirm' => __('この予定を全て削除してもよろしいですか？', $plan['id'])]) ?>
            <?php if ($plan['user_id'] == $user['id']): ?>
              <?= $this->Form->postLink(__('予定の編集'), ['action' => 'detail', $plan['id']], ['class' => 'waves-effect waves-light btn']) ?>
            <?php else: ?>
              <a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'s',$plan->code]); ?>" class="waves-effect waves-light btn modal-trigger">詳細を確認</a>
            <?php endif ?>

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
