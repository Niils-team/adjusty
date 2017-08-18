<?php $this->assign('title', '承認リクエスト'); ?>
<div class="infoBox">
  <h2>承認リクエスト</h2>
  <ul class="collection">
    <li class="collection-item avatar">
      <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle left" />
        <span class="truncate active-info">名前</span>
        <span class="pushedtime">所属</span>
        <p class="right">
          <button class="btn btn delete-btn" type="submit" name="action">削除する</button>
          <button class="btn waves-effect waves-light" type="submit" name="action">承認する</button>
        </p>
    </li>
  </ul>
</div>
