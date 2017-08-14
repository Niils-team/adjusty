<?php $this->assign('title', 'パスワード再設定'); ?>

<div class="remindBox">
  <h1 class="center-align sp-h1">パスワード再設定</h1>
  <p>新しいパスワードを入力してください。</p>
  <div class="row">
  <?= $this->Form->create() ?>
  <div class="row">
    <div class="input-field col s12">
        <?php
            echo $this->Form->input('password', array(
              'label' => array(
                'text' => '新しいパスワード'
              ),
              'div' => false,
              'class' => 'validate',
              'value' => ''
            ));
        ?>
    </div>
    <div class="input-field col s12">
      <label class="active">パスワード再確認</label>
        <?php
            echo $this->Form->password('password_confirm',
              ['class' => 'validate']
            );
        ?>
    </div>
    <div class="center-align">
        <?= $this->Form->button('送信', array(
          'div' => false,
          'class' => 'waves-effect waves-light btn'
        )); ?>
    </div>
  </div>
  <?= $this->Form->end() ?>
  </div>
</div>
