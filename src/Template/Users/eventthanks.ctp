  <div class="navbar-fixed">
    <?php echo $this->element('navigation'); ?>
  </div>

  <div class="eventBox">
    <h1 class="center-align sp-h1">作成完了</h1>
    <div class="completeCircle valign-wrapper center-align">
      <i class="center-block large material-icons teal-text text-accent-3">done</i>
    </div>
    <p>＜タイトル＞の予定が作成されました。</p>
    <div class="row">
      <form class="col s12">
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">open_in_new</i>
            <input disabled value="ここにURLを表示" id="disabled" type="text" class="validate">
          </div>
        </div>
      </form>
    </div>
    <button class="center-block btn waves-effect waves-light" type="submit" name="action">予定ページを開く</button>
  </div>
