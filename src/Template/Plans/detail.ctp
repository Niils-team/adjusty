<!-- <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.8&appId=770692309762027";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->

<?php $this->assign('title', '予定の編集'); ?>

<script>
$(function(){

$('#submit').click(function() {

    var top_title = $("#title").val();
    var top_title_length = $("#title").val().length;
    var top_memo_length = $("#memo").val().length;

    if (!top_title) {
        alert('タイトルが入力されていません')
        return false;
    }

    if (top_title_length >= 40) {
        alert('予定名は40文字以下で入力して下さい')
        return false;
    }

    if (top_memo_length >= 100) {
      alert('メモは100文字以下で入力して下さい')
      return false;
    }



});

});


</script>

<div class="plandetailBox">
    <h1 class="center-align sp-h1 hide-on-small-only">予定の編集</h1>

    <?=$this->Form->create($plan,[
        'type' => 'post',
        'url' => ['controller' => 'Plans', 'action' => 'detailEdit']]
    ) ?>
<?=$this->Form->hidden( 'plan_id' ,['value'=> $plan['id'] ]) ?>
  <h5 class="event-step">予定名</h5>
  <div class="center-align">

      <div class="row">
        <div class="input-field col s12">
          <?php
              echo $this->Form->input('title', array(
                  'label' => array(
                  'text' => false
                ),
                'id' => 'title',
                'class' => 'validate',
                'placeholder' => false
              ));
          ?>
        </div>
      </div>

  </div>

  <h5 class="event-step">メモ</h5>
  <div class="center-align">

      <div class="row">
        <div class="input-field col s12">
          <?php
              echo $this->Form->input('memo', array(
                  'label' => array(
                  'text' => false
                ),
                'id' => 'memo',
                'class' => 'materialize-textarea',
                'placeholder' => false
              ));
          ?>
        </div>
      </div>

  </div>

  <div class="center-align">
    <?=$this->Form->submit('更新',['class' => 'btn','id' => 'submit']); ?>
  </div>
<?=$this->Form->end() ?>

  <?php if (!isset($plan['memo'])): ?>
    <h5 class="event-step">メモ</h5>
    <p class="memo"><?php echo $plan['memo']; ?></p>
  <?php endif; ?>

  <h5 class="event-step">共有URL ※共有URLの編集はできません</h5>
  <div class="center-align">
    <div class="row urlShare">
      <form class="col s12" name="targetForm">
        <div class="row">
          <div class="input-field col s10">
            <input value="<?php echo EVENT_URL.$plan['code']; ?>" id="copyCode" type="text" class="validate" name="inputArea">
          </div>
          <p class="col s2">
            <button name="copyButton" id="copyButton2" class="btn url_copy_btn tooltipped" data-position="top" data-delay="30" data-tooltip="クリックでコピー">
              <i class="tiny material-icons">content_copy</i>
            </button>
          </p>
        </div>
      </form>
    </div>

      <!-- <div class="row">
        <div class="input-field col s12">
          <input type="text" value="<?php echo EVENT_URL.$plan['code']; ?>" class="validate" readonly>
        </div>
      </div> -->

  </div>
  <div class="center-align">
    <div class="socials">
      <!-- Facebook Messenger を開く -->
      <div class="hide-on-med-and-down fb-send" data-href="<?php echo EVENT_URL.$plan['code']; ?>">
      </div>
      <a href="mailto:?subject=&nbsp;&amp;body=<?php echo EVENT_URL.$plan['code']; ?>" class="btn waves-effect waves-light mail-btn"><i class="material-icons">email</i></a>
      <!-- LINE を開く -->
      <div class="line-it-button" data-lang="ja" data-type="share-d" data-url="<?php echo EVENT_URL.$plan['code']; ?>" style="display: none;">
      </div>
      <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
    </div>
  </div>

  <h5 class="event-step">候補日一覧</h5>
  <div class="planlists">
    <?php $i=0; foreach ($events as $event):?>

      <?php
      //日本語の曜日配列
      $weekjp = array(
        '日', //0
        '月', //1
        '火', //2
        '水', //3
        '木', //4
        '金', //5
        '土'  //6
      );

      //現在の曜日番号（日:0  月:1  火:2  水:3  木:4  金:5  土:6）を取得
      $weekno = date('w', strtotime($event['start']));

      ?>


    <?php if ($event['fixed_flag'] == 0): ?>
      <div class="row made-planlists-item">
    <?php else: ?>
      <div class="row made-planlists-item selected">
    <?php endif; ?>


      <div class="col s9">
        <h4 class="etitle">
          <?php echo date('Y', strtotime($event['start'])); ?>年<?php echo date('m', strtotime($event['start'])); ?>月<?php echo date('d', strtotime($event['start'])); ?>日
          （<?php echo $weekjp[$weekno];?>）&nbsp;<?php
          # 終日チェック
          if ($event['allDay'] == 1) {
            echo '終日';
          } else {
            echo date('H:i', strtotime($event['start'])).'〜'.date('H:i', strtotime($event['end']));
          }

          ?></h4>
        <?php if ($event['title'] != null): ?>
          <p><?php echo $event['title']; ?></p>
        <? endif; ?>
        <?php if ($event['fixed_flag'] == 1): ?>
          <p>相手：<?php echo $event['guest_name']; ?></p>
          <p>メールアドレス：<?php echo $event['guest_email']; ?></p>
        <?php endif; ?>

      </div>
      <div class="col s3">
        <?php if ($event['fixed_flag'] == 0): ?>
          <div class="right-align">
            <!-- Dropdown Trigger -->
            <a class='dropdown-button' href='#' data-activates='planmenu<?php echo $i; ?>'><i class="material-icons">more_vert</i></a>
            <!-- Dropdown Structure -->
            <ul id='planmenu<?php echo $i; ?>' class='dropdown-content'>
              <li><a href="<?= $this->Url->build(['controller' => 'Plans', 'action' => 'edit', $plan['id'],$event['id']]); ?>">編集</a></li>
              <li><?= $this->Form->postLink(__('削除'), ['action' => 'deleteEvent', $event['id'],$plan['id']], ['confirm' => __('この候補日を削除してもよろしいですか？', $event['id'])]) ?></li>
            </ul>
          </div>
        <?php else: ?>
            <a class="btn-flat disabled" style="color:#26a69a !important;"><i class="material-icons left">done</i>確定</a>
        <?php endif; ?>
      </div>
    </div>

    <?php $i++; endforeach; ?>

    <a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'add',$plan['id']]); ?>" >
      <div class="addevent">
        <span class="btn-floating grey lighten-1"><i class="material-icons left">add</i></span>&nbsp;候補日を追加
      </div>
    </a>
    <a href="<?php echo $this->Url->build(['controller'=>'Plans', 'action'=>'list']); ?>" class="btn back-btn"><i class="small left material-icons">arrow_back</i>プラン一覧に戻る</a>


  </div>
</div>
