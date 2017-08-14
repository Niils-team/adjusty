<?php $this->assign('title', 'マイページ'); ?>
<div class="mypageBox">
  <div class="mypageBack">
    <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 2]); ?> " />
  </div>

  <div class="mypageImg center-align">
    <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1],[]); ?> " class="circle"/>
  </div>

  <div class="profBox-light">
    <div class="profBox-relative">
      <h5 class="truncate"><?php echo h($user['name']); ?></h5>
      <p class="profBox-text truncate"><i class="tiny left material-icons prefix">business</i><?php echo h($user['company_name']); ?></p>
      <p class="profBox-text truncate"><i class="tiny left material-icons prefix">assignment_ind</i><?php echo h($user['company_position']); ?></p>
      <!-- <a class="profBox-absolute z-depth-1" href="<?= $this->Url->Build(['controller' => 'Users', 'action' => 'img-edit']); ?>"><i class="tiny left material-icons">photo_camera</i><span class="hide-on-small-only">写真を</span>変更</a> -->
    </div>
  </div>

  <div class="mypagetable">
    <table class="bordered">
      <tbody>
        <!--
        <tr>
          <td><i class="small material-icons">schedule</i></td>
          <td>調整中の予定</td>
        </tr>
        <tr>
          <td><i class="small material-icons">restore</i></td>
          <td>過去の予定</td>
        </tr>
        <tr>
        -->
          <td><i class="small material-icons">perm_identity</i></td>
          <td><a href="<?php echo $this->Url->build(['controller'=>'Users', 'action'=>'profile']); ?>">プロフィール編集<i class="small right material-icons">keyboard_arrow_right</i></a>
          </td>
        </tr>
        <tr>
          <td><i class="small material-icons">settings</i></td>
          <td><a href="<?php echo $this->Url->build(['controller'=>'Users', 'action'=>'setting']); ?>">設定<i class="small right material-icons">keyboard_arrow_right</i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
