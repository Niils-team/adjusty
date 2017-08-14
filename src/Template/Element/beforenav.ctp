<nav class="adjusty-nav" role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="<?php echo $this->Url->build(['controller'=>'Pages', 'action'=>'home']); ?>" class="brand-logo">Adjusty</a>
    <ul class="right hide-on-med-and-down">
      <!-- <li><a href="#">Adjustyについて</a></li> -->
      <li><?php echo $this->Html->link('使い方', ['controller'=>'Pages', 'action'=>'howtouse']); ?></a></li>
      <li><?php echo $this->Html->link('お問い合わせ', ['controller'=>'Users', 'action'=>'contact']); ?></li>
      <li><?php echo $this->Html->link('会員登録', ['controller'=>'Users', 'action'=>'entry'], ['class' => 'waves-effect waves-light btn']); ?></li>
      <li><?php echo $this->Html->link('ログイン', ['controller'=>'Users', 'action'=>'login'], ['class' => 'btn-lp']); ?></li>
    </ul>

    <ul id="nav-mobile" class="side-nav">
      <li><?php echo $this->Html->link('トップ', ['controller'=>'Pages', 'action'=>'home']); ?></li>
      <!-- <li><a href="#">Adjustyについて</a></li> -->
      <li><?php echo $this->Html->link('使い方', ['controller'=>'Pages', 'action'=>'howtouse']); ?></a></li>
      <li><?php echo $this->Html->link('お問い合わせ', ['controller'=>'Users', 'action'=>'contact']); ?></li>
      <li><?php echo $this->Html->link('利用規約', ['controller'=>'Pages', 'action'=>'tos']); ?></li>
      <li><a href="https://niils.com/privacypolicy">プライバシーポリシー</a></li>
      <li><a href="https://niils.com/">会社概要</a></li>
      <li><?php echo $this->Html->link('会員登録', ['controller'=>'Users', 'action'=>'entry'], ['class' => 'waves-effect waves-light btn']); ?></li>
      <li><?php echo $this->Html->link('ログイン', ['controller'=>'Users', 'action'=>'login'], ['class' => 'btn-lp']); ?></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
