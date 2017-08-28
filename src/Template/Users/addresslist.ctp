<?php $this->assign('title', '連絡先一覧'); ?>

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
    <h1 class="sp-h1">連絡先一覧</h1>
    <p class="right-align">
      <a href="#add" class="waves-effect waves-light btn modal-trigger">連絡先を追加</a>
    </p>
    <div class="has-address">
      <ul class="collection">

        <?php $i=0; foreach ($friends as $friend): ?>
        <li class="collection-item avatar">
            <img src="<?= $this->Url->build(["controller" => "Users", "action" => "drawOther", $friend->target_id ]); ?>" class="circle" />

            <span class="title">
            <?= h($friend->user->name) ?>
            </span>

            <p class="companyName">
            <?= h($friend->user->company_name) ?>
            </p>

            <div class="secondary-content">
              <!-- Dropdown Trigger -->
              <div class="frienddetail right-align"><a class='dropdown-button' href='#' data-activates='friendmenu<?php echo $i; ?>'><i class="material-icons">more_vert</i></a></div>
            </div>
            <!-- Dropdown Structure -->
            <ul id='friendmenu<?php echo $i; ?>' class='dropdown-content'>
              <li><a href="<?php echo $this->Url->build(['controller'=>'Relationships', 'action'=>'friendprofile', $friend->user->id]); ?>">詳細を見る</a></li>
              <li><?= $this->Form->postLink(__('連携を解除'), ['controller'=>'Relationships','action' => 'delete',$friend->id], ['confirm' => __('連携を解除しますか？')]) ?></li>
            </ul>
            <div class="right-align"><a href="#!" class="btn adjustBtn">予定を送る</a></div>
        </li>

        <?php endforeach ?>

      </ul>

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
            <label for="email" class="left-align">メールアドレス</label>
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
  <button data-remodal-action="cancel" class="remodal-cancel">キャンセル</button>

      <?= $this->Form->button('送信', array(
      'div' => false,
      'class' => 'remodal-confirm'
    ));  ?>
</div>
<?= $this->Form->end() ?>
<!--メールフォーム END-->
