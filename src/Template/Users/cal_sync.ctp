<?php $this->assign('title', 'カレンダー連携設定'); ?>

<?= $this->Form->create($user) ?>
  <div class="remindBox">
    <h1 class="center-align sp-h1">カレンダー連携設定</h1>
    <h5 class="white-text grey darken-1 event-step">Googleカレンダー連携</h5>
    <div class="row">

            <p>
              <input name="is_gcal" type="radio" id="test1" value="0" <?php if ($user['is_gcal'] == 0): ?>
                checked
              <?php endif; ?>/>
              <label for="test1">連携しない</label>
              <input name="is_gcal" type="radio" id="test2" value="1" <?php if ($user['is_gcal'] == 1): ?>
                checked
              <?php endif; ?>/>
              <label for="test2">連携する</label>
            </p>
            <div class="row">
              <div class="input-field col s12">
                <?php
                    echo $this->Form->input('gmail', array(
                        'label' => array(
                        'text' => 'Gmailアドレス'
                      ),
                      'class' => 'validate',
                      'type' => 'email',
                      'placeholder' => 'Gmailアドレス'
                    ));
                ?>
              </div>
            </div>
            <p>
                <a href="https://myaccount.google.com/permissions?pli=1" target="_blank">現在のGoogleアカウント連携を確認</a>
            </p>
    </div>
    <div class="center-align">
      <?= $this->Form->button('設定する', array(
            'div' => false,
            'class' => 'waves-effect waves-light btn',
            'id' => 'submit'
      )); ?>
    </div>
    <?= $this->Form->end() ?>


  </div>
