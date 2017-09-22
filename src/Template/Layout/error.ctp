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
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

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
    <div id="container">
      <nav class="adjusty-nav" role="navigation">
        <div class="nav-wrapper container">
          <a id="logo-container" href="<?= $this->Url->Build(['controller' => 'Plans', 'action' => 'top']); ?>" class="brand-logo">Adjusty</a>
        </div>
      </nav>

        <div id="header">
            <h1 class="center-align"><?= __('エラー') ?></h1>
        </div>
        <div id="content" class="center-align errorpage">
            <?= $this->Flash->render() ?>

            <?= $this->fetch('content') ?>
            <p class="errormessageBox">
              <?= $this->Html->link(__('元のページに戻る'), 'javascript:history.back()', ['class'=>'btn']) ?>
            </p>
        </div>
        <footer class="page-footer">
          <?php echo $this->element('copyright'); ?>
        </footer>
    </div>
</body>
</html>
