<?php $this->assign('title', '新規登録'); ?>

<div class="entryBox">
  <h1 class="center-align sp-h1">新規ユーザー登録</h1>
  <div class="row">
    <p>現在、本リリース前のため、モニター様に限定してサイトをご利用いただいております。</p>
    <p>ご期待にお答えできず申し訳ございませんが、本リリースまでお待ちください。</p>
  </div>
  <div class="center-align">
    <?php echo $this->Html->link('トップへ戻る', ['controller'=>'Pages', 'action'=>'home'], ['class' => 'waves-effect waves-light btn']); ?>
  </div>

  <ul>
    <li><i class="tiny material-icons">play_arrow</i><?php echo $this->Html->link('ログインはこちら', ['controller'=>'Users', 'action'=>'login']); ?></li>
    <li><i class="tiny material-icons">play_arrow</i><?php echo $this->Html->link('パスワードをお忘れの方はこちら', ['controller'=>'Users', 'action'=>'reminder']); ?></li>
  </ul>
</div><!-- end of entryBox -->
