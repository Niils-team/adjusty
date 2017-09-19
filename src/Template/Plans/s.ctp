
<!-- ログインモーダルの起動 -->
<!-- <script>
$(function() {
  $('[data-remodal-id=login]').remodal().open();
});
</script>
 -->

<script>
  $(document).ready(function(){

    // モーダル表示
    $('.modal').modal();

    // Submit前処理
    $('#submit').click(function(){
      var guest_name = $("#guest_name").val();
      if(!guest_name ){
        alert('お名前が入力されていません')
        return false;
      }
    });

    // unfixed Submit前処理
    $('#submit_unfixed').click(function(){
      var guest_name_unfixed = $("#guest_name_unfixed").val();
      if(!guest_name_unfixed ){
        alert('お名前が入力されていません')
        return false;
      }
    });

  });
</script>




<?php
error_reporting(0);
$this->assign('title', '予定の詳細');
?>
<div class="planBox">
  <h1 class="center-align sp-h1">
    <?php if ($plan['title'] == '') {
      echo '予定名未設定';
    } else {
      echo $plan['title'];
    }
    ?>
  </h1>
  <p>
    <?php if ($plan['memo'] == '') {
      echo '';
    } else {
      echo $plan['memo'];
    }
    ?>
  </p>





  <h5 class="event-step">候補日時</h5>
  <div class="planlists">
    <?php
    $i = 0;
    foreach ($events as $event):
      ?>

      <div class="row planlists-item">
        <div class="col s4">
          <ul class="center-align">
            <!-- <li><span><?php echo date('Y', strtotime($event['start'])); ?></span></li> -->
            <li><span class="num-big plan-month"><?php echo date('m/d', strtotime($event['start'])); ?></span></li>
            <!-- <li><span><?php echo date('D', strtotime($event['start'])); ?></span></li> -->
            <li><span>（<?php echo week_check($event['start']); ?>）</span></li>
          </ul>
        </div>
        <div class="col s8">
          <?php echo $event['title']; ?>
          <p class="num-mid">
            <?php
        # 終日チェック
            if ($event['allDay'] == 1) {
              echo '終日';
            } else {
              echo date('G:i', strtotime($event['start'])).'〜'.date('G:i', strtotime($event['end']));
            }

            ?></p>
            <!-- Modal Trigger -->
            <?php
            if ($event['fixed_flag'] == 1) {
              echo '<div class="center-align">この予定は確定しています</div>';
            } else {
              echo '<a class="select-modal" href="#modal'.$i.'"></a>';
            }

            ?>
            <i class="small material-icons select-modal-trigger">keyboard_arrow_right</i>
          </div>




          <!--モーダル START -->
          <div id="modal<?php echo $i; ?>" class="modal">
            <?= $this->Form->create() ?>
            <?=$this->Form->hidden('event_id',['value'=> $event['id']]) ?>
            <?=$this->Form->hidden('plan_id',['value'=> $event['plan_id']]) ?>
            <div class="modal-content">
              <h4 class="modal-font"><?php echo date('Y年m月d日', strtotime($event['start'])); ?></h4>
              <p><?php echo $event['memo']; ?></p>
              <h4 class="modal-font">
                <?php
        # 終日チェック
                if ($event['allDay'] == 1) {
                  echo '終日';
                } else {
                  echo date('G:i', strtotime($event['start'])).'〜'.date('G:i', strtotime($event['end']));
                }

                ?></h4>
                <p>こちらの日時で確定します。よろしいですか？確定する場合はお名前を入力後、「確定」ボタンを押してください。</p>
                <p>メールアドレスをご入力いただくと、この予定の確定連絡が受信できます。</p>
                <?= $this->Form->input('guest_name', array(
                  'label' => array(
                    'text' => 'お名前（必須）'
                  ),
                  'div' => false,
                  'class' => 'form-control',
                  'id' => 'guest_name',
          // 'required' => true

                  )); ?>
                <?= $this->Form->input('email', array(
                  'label' => array(
                    'text' => 'メールアドレス'
                  ),
                  'div' => false,
                  'id' => 'guest_email',
                  'class' => 'form-control',

                  )); ?>
                  <div class="right-align btns">
                    <a href="#!" class="modal-action modal-close waves-effect waves-light btn back2-btn">戻る</a>
                    <?= $this->Form->button('確定', array(
                      'div' => false,
                      'id' => 'submit',
                      'class' => 'waves-effect waves-light btn'
                      ));  ?>
                    </div>
                  </div>
                  <?= $this->Form->end() ?>
                </div>

                <!--モーダル END -->


              </div>
              <?php
              $i++;
            endforeach;
            ?>

            <div class="planlists-item center-align create-btn">
              <a class="select-modal" href="#modal"><p>上記の候補日で都合が合いません</p></a>
              <i class="small material-icons select-modal-trigger">keyboard_arrow_right</i>
            </div>

          </div>

          <!--モーダル START -->
          <div id="modal" class="modal">
            <?=$this->Form->create(null,[
              'type' => 'post',
              'url' => ['controller' => 'plans', 'action' => 'unfixedemail']]
              ) ?>
              <?=$this->Form->hidden('plan_id',['value'=> $plan['id']]) ?>
              <?=$this->Form->hidden('user_id',['value'=> $plan['user_id']]) ?>
              <?=$this->Form->hidden('code',['value'=> $plan['code']]) ?>
              <div class="modal-content">
                <h4 class="modal-font">ご都合が合いません</h4>
                <p>提案された候補日では都合が合いません。</p>
                <?= $this->Form->input('guest_name', array(
                  'label' => array(
                    'text' => 'お名前'
                  ),
                  'div' => false,
                  'class' => 'form-control',
                  'id' => 'guest_name_unfixed',
              // 'required' => true

                  )); ?>

                <?= $this->Form->input('email', array(
                  'label' => array(
                    'text' => 'メールアドレス'
                  ),
                  'div' => false,
                  'id' => 'guest_email',
                  'class' => 'form-control',

                  )); ?>

                  <div class="right-align btns">
                    <a href="#!" class="modal-action modal-close waves-effect waves-light btn back2-btn">戻る</a>
                    <?= $this->Form->button('確定', array(
                      'div' => false,
                      'id' => 'submit_unfixed',
                      'class' => 'waves-effect waves-light btn'
                      ));  ?>
                    </div>
                  </div>
                  <?= $this->Form->end() ?>
                </div>
                <!--モーダル END -->


          <!--ログインモーダル START -->
          <div class="remodal"  data-remodal-id="login" data-remodal-options="hashTracking:false">
            <button data-remodal-action="close" class="remodal-close"></button>
            <h1>ログイン</h1>
            <p>ログインをして自分の予定に情報を追加する</p>
            <button data-remodal-action="cancel" class="remodal-cancel">ログインしない</button>
            <button data-remodal-action="confirm" class="remodal-confirm">ログイン</button>
          </div>
          <!--ログインモーダル END -->




</div>
