<?= $this->Form->create() ?>
<div class="loginBox">
  <h1 class="center-align sp-h1">お問合せ</h1>
  <div class="row">
    <div class="col s12">
      <div class="row">
        <div class="input-field col s12">

          <label for="name">氏名</label>
          <?= $this->Form->text('name', array(
            'div' => false,
            'class' => 'validate',
            'placeholder' => '',
            'value' => $name
          )); ?>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label for="email">Email</label>
          <?= $this->Form->email('email', array(
            'div' => false,
            'class' => 'validate',
            'placeholder' => '',
            'value' => $email
          )); ?>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <label for="textarea1">お問合せ内容</label>
          <?= $this->Form->textarea('body', array(
            'div' => false,
            'class' => 'materialize-textarea',
            'placeholder' => 'お問合せ内容を入力してください',
            'required' => true
          )); ?>
        </div>
      </div>
  </div>
  <div class="center-align">
    <?= $this->Form->button('送信', array(
      'div' => false,
      'class' => 'waves-effect waves-light btn'
    ));  ?>
  </div>
  <?= $this->Form->end() ?>
</div>
</div>
