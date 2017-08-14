
<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'Users', 'action' => 'deleteThanks')
));
?>
  <div class="forgotBox">
    <h1 class="center-align sp-h1">退会手続き</h1>
    <div class="row">
      <div class="col s12">
        <p>下記内容で退会手続きをいたします。</p>
        <h5>退会理由</h5>
        <ul>
          <li><?php echo $reason1; ?></li>
          <li><?php echo $reason2; ?></li>
          <li><?php echo $reason3; ?></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col s12">
        <h5>コメント</h5>
        <input value="<?php echo $body; ?>" type="text" class="validate" readonly="readonly">
      </div>
    </div>
    <div class="center-align">
      <?php echo $this->Html->link('戻る', ['controller'=>'Users', 'action'=>'delete'], ['class' => 'waves-effect waves-light btn']); ?>
      <?=$this->Form->hidden('reason1',['value'=> $reason1 ]) ?>
      <?=$this->Form->hidden( 'reason2' ,['value'=> $reason2 ]) ?>
      <?=$this->Form->hidden( 'reason3' ,['value'=> $reason3 ]) ?>
      <?=$this->Form->hidden( 'body' ,['value'=> $body ]) ?>
      <?= $this->Form->button('退会', array(
        'div' => false,
        'class' => 'waves-effect waves-light btn'
      ));  ?>
      <?= $this->Form->end() ?>
    </div>
  </div>
