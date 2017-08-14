<?php $this->assign('title', 'パスワードをお忘れの方'); ?>

<div class="remindBox">
  <h1 class="center-align sp-h1">パスワードをお忘れの方</h1>
  <p>ご登録のメールアドレスを入力してください。</p>
  <div class="row">
  <?= $this->Form->create() ?>
    <div class="row">
      <div class="input-field col s12">
        <?= $this->Form->input('email', array(
          'label' => array(
            'text' => 'Email'
          ),
          'div' => false,
          'class' => 'validate'
        )); ?>
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

  <ul>
    <li><i class="tiny material-icons">play_arrow</i><?php echo $this->Html->link('新規ユーザー登録はこちら', ['controller'=>'Users', 'action'=>'entry']); ?></li>
    <li><i class="tiny material-icons">play_arrow</i><?php echo $this->Html->link('ログインはこちら', ['controller'=>'Users', 'action'=>'login']); ?></li>
  </ul>
</div><!-- end of userForm -->
