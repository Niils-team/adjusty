<?php $this->assign('title', 'Googleカレンダー設定'); ?>


<?= $this->Form->create($user) ?>
  <div class="remindBox">
    <h1 class="center-align sp-h1">Googleカレンダー設定</h1>
    <p>GoogleカレンダーIDを設定してGoogleカレンダー同期を行います。</p>
    <div class="row">
      <div class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <?php
                echo $this->Form->input('gmail', array(
                    'label' => array(
                    'text' => 'GoogleカレンダーID（Googleアカウント）'
                  ),
                  'class' => 'validate',
                  'placeholder' => 'GoogleカレンダーIDを入力してください'
                ));
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="center-align">
      <?= $this->Form->button('Googleアカウント設定', array(
            'div' => false,
            'class' => 'waves-effect waves-light btn',
            'id' => 'submit'
      )); ?>
    <?= $this->Form->end() ?>


  <?php echo $this->Html->link('Googleカレンダーの連携認証をする', ['controller'=>'Users', 'action'=>'gcal_send'], ['class'=>'waves-effect waves-light btn']); ?>

<a href="https://accounts.google.com/b/0/IssuedAuthSubTokens" class="waves-effect waves-light btn">連携解除</a>

</div>


  </div>
