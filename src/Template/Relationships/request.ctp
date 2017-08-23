<?php $this->assign('title', '承認リクエスト'); ?>
<div class="infoBox">
  <h2>承認リクエスト</h2>
  <ul class="collection">
  <?= $this->Form->create() ?>
    <li class="collection-item avatar">
        <img src="<?= $this->Url->build(["controller" => "Users", "action" => "drawOther", $from_user->id ]); ?>" class="circle" />

        <span class="truncate active-info">名前 <?= h($from_user->name) ?></span>

        <span class="pushedtime">所属 <?= h($from_user->company_name) ?></span>

        <p class="right">


        <?php echo $this -> Form -> button ( "拒否する", [ "class" => "btn btn delete-btn","name" => 'block', "value" => $from_user->id ] ); ?>

        <?php echo $this -> Form -> button ( "承認する", [ "class" => "btn waves-effect waves-light","name" => 'accept', "value" => $from_user->id ] ); ?>

        </p>

    </li>
<?=$this->Form->end() ?>
  </ul>
</div>
