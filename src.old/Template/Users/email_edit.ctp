<?php $this->assign('title', 'メールアドレス変更'); ?>

<script>
$(document).ready(function(){


    // Submit前処理
		$('#submit').click(function(){
      var new_email = $("#new_email").val();
      if(!new_email ){
        alert('メールアドレスが入力されていません')
         return false;
      }

		});

  });
</script>
<?= $this->Form->create() ?>
  <div class="remindBox">
    <h1 class="center-align sp-h1">メールアドレス変更</h1>
    <p>新しいメールアドレスをご入力ください。
      <br>新しいメールアドレスに変更確認のメールが届きます。</p>
    <div class="row">
      <div class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <?php
                echo $this->Form->input('email', array(
                  'label' => array(
                    'text' => 'メールアドレス'
                  ),
                  'class' => 'validate',
                  'id' => 'new_email',
                  'placeholder' => '新しいメールアドレスを入力してください'
                ));
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="center-align">
      <?= $this->Form->button('送信', array(
            'div' => false,
            'class' => 'waves-effect waves-light btn',
            'id' => 'submit'
      )); ?>    </div>
    <?= $this->Form->end() ?>
  </div>
