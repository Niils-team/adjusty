<?php $this->assign('title', 'アカウントリスト'); ?>



<?php if ($friends_cnt == 0): ?>

  <!-- 繋がっているアカウントがない場合 -->
    <div class="addresslistBox">
      <div class="center-align noaddress">
        <p class="center-align">連絡先がありません。<br>
        <!-- Modal Trigger -->
        <a href="#add" class="waves-effect waves-light btn modal-trigger">連絡先を追加</a></p>
      </div>
    </div>
    <!-- 繋がっているアカウントがあった場合 -->

<?php else: ?>
  
  <!-- 繋がっているアカウントがある場合 -->


  <div class="addresslistBox">
    <div class="has-address">
      <ul class="collection">


        <?php foreach ($friends as $friend): ?>
        <li class="collection-item avatar">
            <img src="<?= $this->Url->build(["controller" => "Users", "action" => "drawOther", $friend->target_id ]); ?>" class="circle" />

            <span class="title">
            【名前】<?= h($friend->user->name) ?>
            </span>

            <p class="companyName">
            【会社名】<?= h($friend->user->company_name) ?>
            </p>

            <div class="secondary-content">
            <a href="#!" class="btn list-btn">予定を送る</a><br>
            <a href="#!" class="btn list-btn">詳細を見る</a>

            </div>
        </li>
  
        <?php endforeach ?>

      </ul>

      <p class="center-align">
        <a href="#add" class="waves-effect waves-light btn modal-trigger">連絡先を追加</a>
      </p>

    </div>

  </div>
    <!-- 繋がっているアカウントがある場合 -->

<?php endif; ?>


<!--メールフォーム START-->

<div class="remodal" data-remodal-id="add" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div>
    <h2 id="modal1Title"></h2>
    <p id="modal1Desc">
    <h4>連絡先を追加</h4>
    <p>招待したい相手のメールアドレスを入力してください。</p>
    <div class="row">
 <?= $this->Form->create() ?>
        <div class="row">
          <div class="input-field col s12">
 
                     <?= $this->Form->email('email', array(
            'div' => false,
            'class' => 'validate',
            'placeholder' => '',
            'required' => true
          )); ?>
            <label for="email">メールアドレス</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
          <?= $this->Form->textarea('body', array(
            'div' => false,
            'class' => 'materialize-textarea',
            'placeholder' => ''
          )); ?>
            <label for="textarea1">メッセージ</label>
          </div>
        </div>
    </div>
    </p>
  </div>
  <br>
  <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>

      <?= $this->Form->button('送信', array(
      'div' => false,
      'class' => 'remodal-confirm'
    ));  ?>
</div>
<?= $this->Form->end() ?>
<!--メールフォーム END-->


