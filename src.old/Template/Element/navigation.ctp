<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
  <li><?php echo $this->Html->link('マイページ', ['controller' => 'Users', 'action' => 'mypage']); ?></li>
  <li><?php echo $this->Html->link('設定', ['controller' => 'Users', 'action' => 'setting']); ?></li>
  <li class="divider"></li>
  <li><?php echo $this->Html->link('ログアウト', ['controller' => 'Users', 'action' => 'logout']); ?></li>
</ul>
<nav class="adjusty-nav" role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="<?= $this->Url->Build(['controller' => 'Plans', 'action' => 'top']); ?>" class="brand-logo">Adjusty</a>
    <ul class="right hide-on-med-and-down">
      <li><?php echo $this->Html->link('ホーム', ['controller' => 'Plans', 'action' => 'top']); ?></li>
      <li><?php echo $this->Html->link('新規予定作成', ['controller' => 'Events', 'action' => 'create']); ?></li>
      <li><?php echo $this->Html->link('予定の確認・修正', ['controller' => 'Plans', 'action' => 'top']); ?></li>
      <li><?php echo $this->Html->link('お問い合わせ', ['controller' => 'Users', 'action' => 'contact']); ?></li>
      <li>
        <a class="dropdown-button" href="#!" data-activates="dropdown1">
          <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?> " class="circle responsive-img" />
          <i class="material-icons right">arrow_drop_down</i>
        </a>
      </li>
    </ul>

    <ul id="slide-out" class="side-nav">
      <li>
        <div class="userView">
          <div class="background">
            <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 2]); ?> " />
          </div>
          <a href="#!user"><img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?> " class="circle" /></a>
          <a href="#!name"><span class="white-text name"><?php echo h($auth->user('name').'さん'); ?></span></a>
          <a href="#!email"><span class="white-text email"><?php echo h($auth->user('email')); ?></span></a>
        </div>
      </li>
      <li><?php echo $this->Html->link('ホーム', ['controller' => 'Plans', 'action' => 'top']); ?></li>
      <li><?php echo $this->Html->link('新規予定作成', ['controller' => 'Events', 'action' => 'create']); ?></li>
      <li><?php echo $this->Html->link('予定の確認・修正', ['controller' => 'Plans', 'action' => 'top']); ?></li>
      <li><?php echo $this->Html->link('マイページ', ['controller' => 'Users', 'action' => 'mypage']); ?></li>
      <li><?php echo $this->Html->link('設定', ['controller' => 'Users', 'action' => 'setting']); ?></li>
      <li><a href="#!">利用規約</a></li>
      <li><a href="#!">プライバシーポリシー</a></li>
      <li><?php echo $this->Html->link('お問い合わせ', ['controller' => 'Users', 'action' => 'contact']); ?></li>
      <li><div class="divider"></div></li>
      <li><?php echo $this->Html->link('ログアウト', ['controller' => 'Users', 'action' => 'logout']); ?></li>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
