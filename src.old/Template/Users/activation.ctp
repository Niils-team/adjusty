<?php $this->assign('title', '本登録'); ?>

<div class="loginBox">
  <h1 class="center-align sp-h1">本登録</h1>
  <div class="row">
    <?= $this->Form->create($user) ?>
    <div class="row">
      <div class="input-field col s12">
      <?php
        echo $this->Form->input('name', array(
          'label' => array(
            'text' => '氏名'
          ),
          'class' => 'validate',
        ));
      ?>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s12">
      <?php
          echo $this->Form->input('password', array(
            'label' => array(
              'text' => 'パスワード(6文字以上20文字以下の半角英数)'
            ),
            'class' => 'validate',
            'placeholder' => 'パスワードを入力してください'
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
            'placeholder' => '確認のため再度入力してください'
          ));
      ?>
      <label class="active">再確認</label>
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
