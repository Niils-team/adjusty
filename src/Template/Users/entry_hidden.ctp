<?php $this->assign('title', '新規登録'); ?>

<div class="entryBox">
  <h1 class="center-align sp-h1">新規ユーザー登録</h1>
  <div class="row">
  <?= $this->Form->create($user) ?>
    <div class="row">
      <div class="input-field col s12">
        <?= $this->Form->input('email', array(
            'label' => array(
              'text' => 'Email'
            ),
            'div' => false,
            'class' => 'validate',
            'placeholder' => 'メールアドレスを入力してください'
          ));
        ?>
      </div>
    </div>
    <div class="center-align">
      <?= $this->Form->button('登録する', array(
        'div' => false,
        'class' => 'waves-effect waves-light btn'
      ));  ?>
    </div>
    <?= $this->Form->end() ?>
  </div>
  <ul>
    <li><i class="tiny material-icons">play_arrow</i><?php echo $this->Html->link('ログインはこちら', ['controller'=>'Users', 'action'=>'login']); ?></li>
    <li><i class="tiny material-icons">play_arrow</i><?php echo $this->Html->link('パスワードをお忘れの方はこちら', ['controller'=>'Users', 'action'=>'reminder']); ?></li>
  </ul>
</div><!-- end of entryBox -->
