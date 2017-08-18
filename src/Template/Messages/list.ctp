<?php $this->assign('title', 'お知らせ一覧'); ?>
<div class="infoBox">
  <h2>お知らせ一覧</h2>
  <ul class="collection">
    <li class="collection-item avatar">
      <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle left" />
      <a href="<?= $this->Url->Build(['controller' => 'Plans', 'action' => 'list']); ?>">
        <span class="active-info">○○さんから予定調整依頼が届いています。</span><br>
        <span class="pushedtime">1時間前</span>
      </a>
    </li>
    <li class="collection-item avatar">
      <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle left" />
      <a href="<?= $this->Url->Build(['controller' => 'Relationships', 'action' => 'request']); ?>">
        ○○さんから承認リクエストが届いています。<br>
        <span class="pushedtime">1時間前</span>
      </a>
    </li>
    <li class="collection-item avatar">
      <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle left" />
      <a href="#">
        ○○さんから承認リクエストが届いています。<br>
        <span class="pushedtime">1時間前</span>
      </a>
    </li>
    <li class="collection-item avatar">
      <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle left" />
      <a href="#">
        ○○さんから承認リクエストが届いています。<br>
        <span class="pushedtime">1時間前</span>
      </a>
    </li>
    <li class="collection-item avatar">
      <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle left" />
      <a href="#">
        ○○さんから承認リクエストが届いています。<br>
        <span class="pushedtime">1時間前</span>
      </a>
    </li>
  </ul>
  <p class="center-align"><a href="#" class="btn-floating btn-large waves-effect waves-light white"><i class="material-icons">keyboard_arrow_down</i></a></p>
</div>
