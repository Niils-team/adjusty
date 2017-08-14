<nav class="blue-grey darken-2" role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="#" class="brand-logo">マイページ</a>
    <ul class="right hide-on-med-and-down">
      <li><a href="#">Adjustyについて</a></li>
      <li><a href="#">使い方</a></li>
      <li><a href="#">よくある質問</a></li>
      <li><a href="#">お問合せ</a></li>
    </ul>

    <ul id="slide-out" class="side-nav">
      <li><div class="userView">
        <div class="background">
          <?php echo $this->Html->image('background_sample.jpg'); ?>
        </div>
        <a href="#!user"><?php echo $this->Html->image('hiroshi1.jpg', ['class' => 'circle']); ?></a>
        <a href="#!name"><span class="white-text name">山口　洋</span></a>
        <a href="#!email"><span class="white-text email">hiroshi5842@gmail.com</span></a>
      </div></li>
      <li><?php echo $this->Html->link('マイページ', ['controller' => 'Pages', 'action' => 'mypage']); ?></li>
      <li><a href="#!">設定</a></li>
      <li><a href="#!">利用規約</a></li>
      <li><a href="#!">プライバシーポリシー</a></li>
      <li><a href="#!">お問合せ</a></li>
      <li><div class="divider"></div></li>
      <li><?php echo $this->Html->link('ログアウト', ['controller' => 'Pages', 'action' => 'logout']); ?></li>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
