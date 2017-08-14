
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

      <h5 class="white-text grey darken-1 event-step">Step 1.　タイトルとメモ</h5>
      <div class="row">

        <div class="input-field col s12">
              <?= $this->Form->input('title', array(
                'label' => array(
                  'text' => '',
                ),
                'div' => false,
                'class' => 'validate',
                            'id' => 'event_title',
                'placeholder' => 'タイトルを入力してください',
                // 'required' => true

              )); ?>
          <label class="active">タイトル（必須）</label>
        </div>
        <div class="input-field col s12">
          <!-- <label>メモ</label> -->
              <?= $this->Form->textarea('memo', array(
                'div' => false,
                'class' => 'materialize-textarea',
                'placeholder' => '予定に関するメモを保存できます',
              )); ?>
          <label class="active">メモ</label>
        </div>
    	</div>

   </div><!--STEP1 END -->

   <div class="row"><!--STEP2 STRAT -->

       <h5 class="white-text grey darken-1 event-step">Step 2.　候補日を決める</h5>
       <div class="row">

         <div class="input-field col s12">

            <div id='list'>
            <div id='data'></div>
            </div>

        </div>
      </div>
      <div class="addevent">
        <a href="#animatedModal" id="modal"><span class="btn-floating blue"><i class="material-icons left">add</i></span>&nbsp;候補日を追加</a>
      </div>

        <div class="center-align create-btn">
           <?= $this->Form->button('予定を作成', array(
                'div' => false,
              'id' => 'submit',
                 'class' => 'btn waves-effect waves-light',
               )); ?>
        </div>

  </div><!--STEP2 END -->
 	</div><!-- eventBox -->

<?= $this->Form->end() ?>
