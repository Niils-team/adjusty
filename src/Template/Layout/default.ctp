<?php

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>
      <?= $this->fetch('title') ?><?= ' | Adjusty（アジャスティ）' ?>
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
    <?= $this->Html->script('moment.min') ?>
    <?= $this->Html->script('jquery.min') ?>

    <?= $this->Html->script('datepicker-ja.js') ?>
    <?= $this->Html->script('imgLiquid-min.js') ?>

    <?= $this->Html->css('reset.css') ?>
    <?= $this->Html->css('//fonts.googleapis.com/icon?family=Material+Icons') ?>
    <?= $this->Html->css('//fonts.googleapis.com/css?family=Niconne') ?>
    <?= $this->Html->css('//fonts.googleapis.com/earlyaccess/mplus1p.css') ?>
    <?= $this->Html->css('materialize.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('animate.min.css') ?>



    <?= $this->Html->css('fullcalendar.min') ?>
    <?= $this->Html->css('fullcalendar.print', array('media' => 'print')) ?>


    <?= $this->Html->script('fullcalendar') ?>
    <?= $this->Html->script('ja') ?>
    <?= $this->Html->script('gcal') ?>


    <!-- datetimepicker -->

    <?= $this->Html->script('wickedpicker.js') ?>
    <?= $this->Html->script('animatedModal.js') ?>


    <!-- remodal -->
    <?= $this->Html->css('remodal-default-theme') ?>
    <?= $this->Html->css('remodal') ?>
    <?= $this->Html->script('remodal') ?>

    <?= $this->Html->script('jquery-ui') ?>
    <?= $this->Html->css('jquery-ui.css') ?>

    <?= $this->Html->script('cropbox') ?>


    <?= $this->Html->script('jQueryRotate') ?>
    <?= $this->Html->script('load-image.all.min') ?>
    <?= $this->Html->script('exif') ?>
    <?= $this->Html->script('megapix-image') ?>



</head>
<body>

  <div class="navbar-fixed">
    <?php echo $this->element('navigation'); ?>
  </div>

    <?= $this->Flash->render() ?>

    <?= $this->fetch('content') ?>

    <footer class="page-footer">
      <?php echo $this->element('copyright'); ?>
    </footer>
  <!--  Scripts-->
  <?= $this->Html->script('materialize.js') ?>
  <?= $this->Html->script('init.js') ?>






</body>
</html>
