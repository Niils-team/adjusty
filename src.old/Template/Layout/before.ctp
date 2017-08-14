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
<head>
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

    <?= $this->Html->css('reset.css') ?>
    <?= $this->Html->css('//fonts.googleapis.com/icon?family=Material+Icons') ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Niconne') ?>
    <?= $this->Html->css('//fonts.googleapis.com/earlyaccess/mplus1p.css') ?>
    <?= $this->Html->css('materialize.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('animate.min.css') ?>

    <?= $this->Html->script('moment.min') ?>
    <?= $this->Html->script('jquery.min') ?>


    <!-- datetimepicker -->
    <!-- <?= $this->Html->script('jquery.datetimepicker.js') ?> -->
    <?= $this->Html->css('jquery.datetimepicker.css') ?>
    <?= $this->Html->script('jquery.datetimepicker.full.js') ?>
    <?= $this->Html->script('wickedpicker.js') ?>
    <?= $this->Html->script('animatedModal.js') ?>
</head>
<body>
  <div class="navbar-fixed">
    <?php echo $this->element('beforenav'); ?>
  </div>
    <?= $this->Flash->render() ?>
    <?= $this->fetch('content') ?>
    <footer class="page-footer">
      <?php echo $this->element('copyright'); ?>
    </footer>
  <!--  Scripts-->
  <?= $this->Html->script('//code.jquery.com/jquery-2.1.1.min.js') ?>
  <?= $this->Html->script('materialize.js') ?>
  <?= $this->Html->script('init.js') ?>
</body>
</html>
