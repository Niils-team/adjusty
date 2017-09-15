<?php $this->assign('title', 'パスワード変更'); ?>

<div class="loginBox">
  <h1 class="center-align sp-h1">パスワード変更</h1>
  <div class="row">
    <?= $this->Form->create() ?>

    <div class="row">
      <div class="input-field col s12">
        <?php
            echo $this->Form->input('old_password', array(
              'label' => array(
                'text' => '現在のパスワード'
              ),
              'type' => 'password',
              'class' => 'validate',
              'placeholder' => '現在のパスワードを入力してください',
              'required' => true
            ));
        ?>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <?php
            echo $this->Form->input('password', array(
              'label' => array(
                'text' => '新しいパスワード'
              ),
              'class' => 'validate',
              'placeholder' => 'パスワードを入力してください',
              'required' => true

            ));
        ?>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
        <?php
            echo $this->Form->password('password_confirm', array(
              'label' => false,
              'class' => 'validate',
              'placeholder' => '確認のため再度入力してください',
              'required' => true
            ));
        ?>
        <label>確認</label>
      </div>
    </div>
    <div class="center-align">
      <?= $this->Form->button('送信', array(
            'div' => false,
            'class' => 'waves-effect waves-light btn'
      )); ?>
    </div>
    <?= $this->Form->end() ?>
  </div>
</div><!-- end of loginBox -->
