<?php $this->assign('title', 'マイページ'); ?>
<div class="mypageBox">
  <div class="mypageBack">
    <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 2]); ?> " /><br>
  </div>

  <div class="mypageImg center-align">
    <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle" /><br>
  </div>

  <div class="profBox-light">
    <div class="profBox-relative">
      <div class="right-align">
        <a class="profBox-absolute z-depth-1" href="<?php echo $this->Url->build(['controller'=>'Users', 'action'=>'imgEdit']); ?>" class="waves-effect waves-light btn-floating blue-grey"><i class="tiny left material-icons">photo_camera</i><span class="hide-on-small-only">写真を</span>変更</a>
      </div>
    </div>
  </div>


  <div class="mypagetable">

  <?= $this->Form->create($user) ?>
        <div class="row">

              <?= $this->Form->input('name', array(
                'label' => array(
                  'text' => '名前'
                ),
                'div' => false,
                'class' => 'validate',
                'value' => $user['name']
              )); ?>

              <?= $this->Form->input('company_name', array(
                'label' => array(
                  'text' => '会社名'
                ),
                'div' => false,
                'class' => 'validate',
                'value' => $user['company_name']
              )); ?>

              <?= $this->Form->input('company_address', array(
                'label' => array(
                  'text' => '会社住所'
                ),
                'div' => false,
                'class' => 'validate',
                'value' => $user['company_address']
              )); ?>

              <?= $this->Form->input('company_dep', array(
                'label' => array(
                  'text' => '部門名'
                ),
                'div' => false,
                'class' => 'validate',
                'value' => $user['company_dep']
              )); ?>

              <?= $this->Form->input('company_position', array(
                'label' => array(
                  'text' => '肩書'
                ),
                'div' => false,
                'class' => 'validate',
                'value' => $user['company_position']
              )); ?>

              <?= $this->Form->input('company_url', array(
                'label' => array(
                  'text' => 'URL'
                ),
                'div' => false,
                'class' => 'validate',
                'value' => $user['company_url']
              )); ?>

        </div>

      <div class="center-align">
        <?= $this->Form->button('編集する', array(
          'div' => false,
          'class' => 'waves-effect waves-light btn'
        ));  ?>
      </div>

  <?= $this->Form->end() ?>
  </div>
</div>
