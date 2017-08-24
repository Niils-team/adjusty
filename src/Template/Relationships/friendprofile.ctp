<div class="mypageBox">
  <div class="mypageBack">
    <img src="<?= $this->Url->build(["controller" => "Users", "action" => "drawOtherBack", $target_user->id ]); ?>"><br>
  </div>

  <div class="mypageImg center-align">
    <img src="<?= $this->Url->build(["controller" => "Users", "action" => "drawOther", $target_user->id ]); ?>" class="circle" /><br>
  </div>


  <div class="friendpagetable">
      <div class="row">
        <div class="col s12">
          <label for="name" class="active">名前</label>
          <p><?= h($target_user->name) ?></p>
        </div>
        <div class="col s12">
          <label for="company-name" class="active">会社名</label>
          <p><?= h($target_user->company_name) ?></p>
        </div>
        <div class="col s12">
          <label for="company-address" class="active">会社住所</label>
          <p><?= h($target_user->company_address) ?></p>
        </div>
        <div class="col s12">
          <label for="company-dep" class="active">部門名</label>
          <p><?= h($target_user->company_dep) ?></p>
        </div>
        <div class="col s12">
          <label for="company-position" class="active">肩書</label>
          <p><?= h($target_user->company_position) ?></p>
        </div>
        <div class="col s12">
          <label for="company-url" class="active">URL</label>
          <?= h($target_user->company_url) ?>
        </div>
      </div>
  </div>
</div>