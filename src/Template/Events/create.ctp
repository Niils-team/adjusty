
<?= $this->Html->script('event_create') ?>
<?= $this->Html->script('create_calendar') ?>
<?php $this->assign('title', '新規作成'); ?>



<!--Modal STRAT-->
<div id="animatedModal">

  <div class="modal-content">

    <div id='calendar'></div>

    <div class="modal-footer">

      <div  id="btn-close-modal" class="close-animatedModal">
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn back2-btn">カレンダーを閉じる</a>
      </div>


    </div>
  </div>

</div>
<!--Modal END-->

<!--日付入力 START-->
<div class="remodal" data-remodal-id="modal" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
  <button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
  <div>
    <h2 id="modal1Title"></h2>
    <p id="modal1Desc">
      <div class="row">
        <div class="input-field col s6">
          <input id="date-start" class="form-control" type="text" eadonly="readonly" >
          <label class="active2">開始日</label>
        </div>
        <div class="input-field col s6">
          <input id="time-start" class="form-control" type="time">
          <label class="active2">開始時間</label>
        </div>
        <div class="input-field col s6">
          <input id="date-end" class="form-control" type="text" eadonly="readonly" >
          <label class="active2">終了日</label>
        </div>
        <div class="input-field col s6">
          <input id="time-end" class="form-control" type="time">
          <label class="active2">終了時間</label>
        </div>
        <div class="input-field col s12">
          <input type="text" name="title" id="title" placeholder="この候補日のメモを入れてください" >
          <label class="active2">メモ</label>
        </div>
      </div>
    </p>
  </div>
  <br>
  <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
  <button data-remodal-action="confirm" class="remodal-confirm" id="add">OK</button>
</div>
<!--日付入力 END-->



<?= $this->Form->create() ?>
<div class="eventBox">

  <h1 class="center-align sp-h1">予定作成</h1>



  <div class="row"><!--STEP1 START -->

      <h5 class="event-step">予定名とメモ</h5>
      <div class="row">

        <div class="input-field col s12">
              <?= $this->Form->input('title', array(
                'label' => array(
                  'text' => '',
                ),
                'div' => false,
                'class' => 'validate',
                'id' => 'event_title',
                'placeholder' => '予定名を入力してください',
                // 'required' => true

              )); ?>
          <label class="active">予定名<span class="required">（必須）</span></label>
        </div>
        <div class="input-field col s12">
          <!-- <label>メモ</label> -->
              <?= $this->Form->textarea('memo', array(
                'div' => false,
                'class' => 'materialize-textarea',
                'id' => 'event_memo',
                'placeholder' => '予定に関するメモを保存できます',
              )); ?>
          <label class="active">メモ</label>
        </div>
      </div>

   </div><!--STEP1 END -->

   <div class="row"><!--STEP2 STRAT -->

       <h5 class="event-step">候補日を決める</h5>
       <div class="row">

         <div class="input-field col s12">

            <div id='list'>
            <div id='data'></div>
            </div>

        </div>
      </div>
      <a href="#animatedModal" id="modal">
        <div class="addevent">
        <span class="btn-floating grey lighten-1"><i class="material-icons left">add</i></span>&nbsp;候補日を追加
        </div>
      </a>

  </div><!--STEP2 END -->

  <div class="row"><!--STEP3 STRAT -->
<!--     <h5 class="event-step">送信先</h5>
      <div class="row">
        <div class="input-field col s12">
          <p>
            <input name="radioBtn" type="radio" id="to_url" />
            <label for="to_url">URLで送信</label>
          </p>
          <p>
            <input name="radioBtn" type="radio" id="to_friend" />
            <label for="to_friend">連絡先から選ぶ</label>
          </p>
        </div>
      </div> -->

      <div class="center-align create-btn">
         <?= $this->Form->button('予定を作成', array(
              'div' => false,
            'id' => 'submit',
               'class' => 'btn waves-effect waves-light',
             )); ?>
      </div>

 </div><!--STEP3 END -->
 <!-- Frient list Modal START -->
<!--  <ul class="collection">
   <li class="collection-item avatar">
     <input name="friendSelect" type="radio" />
     <label>
       <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle" />
       <span class="title">【名前】</span>
       <p class="companyName">【会社名】</p>
     </label>
   </li>
   <li class="collection-item avatar">
     <input name="friendSelect" type="radio" />
     <label>
       <div>
         <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle" />
         <span class="title">【名前】</span>
         <p class="companyName">【会社名】</p>
       </div>
     </label>
   </li>
   <li class="collection-item avatar">
     <input name="friendSelect" type="radio" />
     <label>
       <img src="<?= $this->Url->build(["controller" => "Users", "action" => "draw", 1]); ?>" class="circle" />
       <span class="title">【名前】</span>
       <p class="companyName">【会社名】</p>
     </label>
   </li>
 </ul> -->
 <!-- Frient list Modal END -->

  </div><!-- eventBox -->

<?= $this->Form->end() ?>
