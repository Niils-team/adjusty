<?php $this->assign('title', 'お知らせ一覧'); ?>
<div class="infoBox">
  <h2>お知らせ一覧</h2>
  <ul class="collection">
  <?php foreach ($messages as $message): ?>

  <?php endforeach ?>

  <?php if ($msg_cnt > 0): ?>

  <?php foreach ($messages as $message): ?>

  <li class="collection-item avatar">
  <img src="<?= $this->Url->build(["controller" => "Users", "action" => "drawOther", $message->from_id ]); ?>" class="circle left" />
  <a href="<?= $this->Url->build(["controller" => "Relationships", "action" => "request",$message->from_id,$message->id]); ?>" class="right">
        <span class="active-info"><?=h($message->user->name) ?>さんから<?=h($message->title) ?></span><br>
        <span class="pushedtime"><?php echo convert_to_fuzzy_time($message['modified']);?></span>
      </a>
    </li>

  <li class="divider"></li>

<?php endforeach ?>

  <li class="see-all"><a href="<?= $this->Url->Build(['controller' => 'Messages', 'action' => 'list']); ?>">全ての通知を見る</a></li>

<?php else: ?>

    <li class="center-align">メッセージはありません</li>

<?php endif ?>
  </ul>
  <p class="center-align"><a href="#" class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons">keyboard_arrow_down</i></a></p>
</div>
