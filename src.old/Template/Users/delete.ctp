<?php
echo $this->Form->create(false, array(
    'url' => array('controller' => 'Users', 'action' => 'deleteConfirm'),
    'id' => 'RecipesAdd',
    // 'method'  => 'GET'
));
?>
  <div class="forgotBox">
    <h1 class="center-align sp-h1">退会</h1>
    <div class="row">
      <div class="col s12">
        <p>退会理由について、アンケートにご協力ください。</p>
        <p>
          <input type="checkbox" class="filled-in" name="reason1" value="使う機会がない" id="filled-in-box1"/>
          <label for="filled-in-box1">使う機会がない</label>
        </p>
        <p>
          <input type="checkbox" class="filled-in" name="reason2" value="使いづらい" id="filled-in-box2"/>
          <label for="filled-in-box2">使いづらい</label>
        </p>
        <p>
          <input type="checkbox" class="filled-in" name="reason3" value="不便" id="filled-in-box3"/>
          <label for="filled-in-box3">不便</label>
        </p>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">mode_edit</i>
            <label for="icon_prefix2">コメント</label>

            <?= $this->Form->textarea('body', array(
              'div' => false,
              'class' => 'materialize-textarea',
              'placeholder' => '',
              // 'required' => true
            )); ?>


          </div>
        </div>

    </div>
    <div class="center-align">
      <?php echo $this->Html->link('戻る', ['controller'=>'Users', 'action'=>'setting'], ['class' => 'waves-effect waves-light btn']); ?>
      <?= $this->Form->button('確認', array(
        'div' => false,
        'class' => 'waves-effect waves-light btn'
      ));  ?>
    </div>
  </div>
<?= $this->Form->end() ?>
</div>
