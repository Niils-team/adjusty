<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>
        予定調整をシンプルに | Adjusty（アジャスティ）
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->meta('apple-touch-icon-precomposed', '/img/apple-touch-icon-144x144.png', [
      'type'=>'icon',
      'size' => '144x144',
      'rel'=>'apple-touch-icon-precomposed'
    ]) ?>
    <?= $this->Html->meta('apple-touch-icon-precomposed', '/img/apple-touch-icon-114x114.png', [
      'type'=>'icon',
      'size' => '114x114',
      'rel'=>'apple-touch-icon-precomposed'
    ]) ?>

    <meta property="og:title" content="予定調整をシンプルに | Adjusty（アジャスティ）" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://adjusty.me" />
    <meta property="og:image" content="https://adjusty.me/img/ogp_img.jpg" />
    <meta property="og:site_name" content="Adjusty" />
    <meta property="og:description" content="Adjusty（アジャスティ）は、
    ビジネスにおける1対1のアポイントを効率的に確定させるWebサービスです。
    複数の候補日を相手に送る場合や、複数の方に自分の空いている日を伝える場合にとても有効な手段です。
    1つの候補日は一人の方のみ確定させることができます。複数の方に同じ日を選択させることはできません。
    それにより、ダブルブッキングが起こることを防ぎます。" />
    <!-- Facebook用設定 -->
    <meta property="fb:app_id" content="770692309762027" />

    <?= $this->Html->css('reset.css') ?>
    <?= $this->Html->css('//fonts.googleapis.com/icon?family=Material+Icons') ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Niconne') ?>
    <?= $this->Html->css('//fonts.googleapis.com/earlyaccess/mplus1p.css') ?>
    <?= $this->Html->css('materialize.css') ?>
    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

</head>
<body>
  <div class="navbar-fixed">
    <?php echo $this->element('beforenav'); ?>
  </div>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <footer class="page-footer lp-footer">
      <div class="container">
        <div class="row">
          <div class="col l6 s12 hide-on-small-only">
            <p><?php echo $this->Html->link('無料で今すぐ始める', ['controller' => 'Users', 'action' => 'entry'],['class' => 'btn-lp']); ?></p>
            <p><?php echo $this->Html->link('ログイン', ['controller' => 'Users', 'action' => 'login'],['class' => 'btn-lp']); ?></p>
            <ul>
              <li><a class="white-text" href="<?php echo $this->Url->build(['controller' => 'Pages', 'action' => 'tos']) ?>"><i class="left tiny material-icons">play_arrow</i>利用規約</a></li>
              <li><a class="white-text" href="https://niils.com/privacypolicy"><i class="left tiny material-icons">play_arrow</i>プライバシーポリシー</a></li>
              <li><a class="white-text" href="https://niils.com/"><i class="left tiny material-icons">play_arrow</i>運営会社</a></li>
            </ul>
          </div>
          <div class="col l6 s12">
            <h5 class="center-align white-text">ご意見・ご要望</h5>
            <p class="center-align"><?php echo $this->Html->link('お問合せ', ['controller' => 'Users', 'action' => 'contact'],['class' => 'btn-lp']); ?></p>
          </div>
        </div>
      </div>
      <?php echo $this->element('copyright'); ?>
    </footer>
  <!--  Scripts-->
  <?= $this->Html->script('//code.jquery.com/jquery-2.1.1.min.js') ?>
  <?= $this->Html->script('materialize.js') ?>
  <?= $this->Html->script('init.js') ?>
</body>
</html>
