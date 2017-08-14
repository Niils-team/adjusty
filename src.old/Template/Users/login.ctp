<?php $this->assign('title', 'ログイン'); ?>

<div class="loginBox">
  <h1 class="center-align sp-h1">ログイン</h1>
  <div class="row">
  <?= $this->Form->create() ?>
    <div class="row">
      <div class="input-field col s12">
      <?= $this->Form->input('email', array(
        'label' => array(
          'text' => 'Email'
        ),
        'div' => false,
        'class' => 'validate',
        'placeholder' => 'メールアドレスを入力してください'
      )); ?>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
      <?= $this->Form->input('password', array(
        'label' => array(
          'text' => 'パスワード'
        ),
        'div' => false,
        'class' => 'validate',
        'placeholder' => 'パスワードを入力してください'
      )); ?>
      </div>
    </div>

    <div class="row">
      <p class="pad">
        <input type="checkbox" class="filled-in" id="filled-in-box1" name="autologin" value="1"/>
        <label for="filled-in-box1">ログイン状態を保持する</label>
      </p>
    </div>

    <div class="center-align">
    <?= $this->Form->button('ログイン', array(
      'div' => false,
      'class' => 'waves-effect waves-light btn'
    )); ?>
    </div>
  <?= $this->Form->end() ?>
  </div>
  <ul>
    <li><i class="tiny material-icons">play_arrow</i><?php echo $this->Html->link('Googleアカウントでログインする', ['controller'=>'Users', 'action'=>'sendGoogle']); ?></li>
    <li><i class="tiny material-icons">play_arrow</i><?php echo $this->Html->link('新規ユーザー登録はこちら', ['controller'=>'Users', 'action'=>'entry']); ?></li>
    <li><i class="tiny material-icons">play_arrow</i><?php echo $this->Html->link('パスワードをお忘れの方はこちら', ['controller'=>'Users', 'action'=>'reminder']); ?></li>
  </ul>
</div><!-- end of loginBox -->
