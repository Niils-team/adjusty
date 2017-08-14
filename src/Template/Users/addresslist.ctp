<?php $this->assign('title', 'アカウントリスト'); ?>

<!-- Modal Structure -->
<div id="addressmodal" class="modal">
  <div class="modal-content">
    <h4>連絡先を追加</h4>
    <p>招待したい相手のメールアドレスを入力してください。</p>
    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <input id="email" type="email" class="validate">
            <label for="email">メールアドレス</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <textarea id="textarea1" class="materialize-textarea"></textarea>
            <label for="textarea1">メッセージ</label>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">招待メールを送信</a>
  </div>
</div>


<?php if ($friend_cnt == 0): ?>

  <!-- 繋がっているアカウントがない場合 -->
    <div class="addresslistBox">
      <div class="center-align noaddress">
        <p class="center-align">連絡先がありません。<br>
        <!-- Modal Trigger -->
        <a href="<?php echo $this->Url->build(['controller'=>'Users', 'action'=>'index']); ?>" class="waves-effect waves-light btn modal-trigger">連絡先を追加</a></p>
      </div>
    </div>
    <!-- 繋がっているアカウントがあった場合 -->

<?php else: ?>
  
  <!-- 繋がっているアカウントがある場合 -->
  <div class="addresslistBox">
    <div class="has-address">
      <ul class="collection">
        <li class="collection-item avatar">
            <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle" />
            <span class="title">【名前】</span>
            <p class="companyName">【会社名】</p>
            <div class="secondary-content"><a href="#!" class="btn list-btn">予定を送る</a><br><a href="#!" class="btn list-btn">詳細を見る</a></div>
        </li>
        <li class="collection-item avatar">
            <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle" />
            <span class="title">【名前】</span>
            <p class="companyName">【会社名】</p>
            <div class="secondary-content"><a href="#!" class="btn list-btn">予定を送る</a><br><a href="#!" class="btn list-btn">詳細を見る</a></div>
        </li>
        <li class="collection-item avatar">
            <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle" />
            <span class="title">【名前】</span>
            <p class="companyName">【会社名】</p>
            <div class="secondary-content"><a href="#!" class="btn list-btn">予定を送る</a><br><a href="#!" class="btn list-btn">詳細を見る</a></div>
        </li>
      </ul>

      <p class="center-align">
        <a href="#" class="waves-effect waves-light btn">連絡先を追加</a>
      </p>

    </div>

  </div>
    <!-- 繋がっているアカウントがある場合 -->

<?php endif; ?>
