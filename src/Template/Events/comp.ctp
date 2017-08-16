<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.8&appId=770692309762027";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="eventcompBox">
  <h1 class="center-align sp-h1">作成完了</h1>
  <div class="completeCircle valign-wrapper center-align">
    <i class="center-block large material-icons teal-text text-accent-3">done</i>
  </div>
  <p class="center-align"><?php echo $plan['title']; ?>&nbsp;の予定が作成されました。予定閲覧ページのURLをお相手にお知らせください。</p>
  <div class="row urlShare">
    <form class="col s12" name="targetForm">
      <div class="row">
        <div class="input-field col s10">
          <input value="<?php echo $plan_url ?>" id="yourCode" type="text" class="validate" name="inputArea">
          <label class="active">【共有URL】</label>
        </div>
        <p class="col s2">
          <button name="copyButton" id="copyButton" class="btn url_copy_btn tooltipped" data-position="top" data-delay="30" data-tooltip="クリックでコピー">
            <i class="tiny material-icons">content_copy</i>
          </button>
        </p>
    </div>
  </form>
</div>
  <div class="center-align">
    <p>ここから相手に送る</p>
    <div class="socials">
      <!-- Facebook Messenger を開く -->
      <div class="hide-on-med-and-down fb-send" data-href="<?php echo $plan_url ?>">
      </div>
      <a href="mailto:?subject=&nbsp;&amp;body=<?php echo $plan_url ?>" class="btn waves-effect waves-light mail-btn"><i class="material-icons">email</i></a>
      <!-- LINE を開く -->
      <div class="line-it-button" data-lang="ja" data-type="share-d" data-url="<?php echo $plan_url ?>" style="display: none;">
      </div>
      <script src="https://d.line-scdn.net/r/web/social-plugin/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
    </div>
  </div>
  <div class="center-align">
    <a href="<?= $this->Url->build(['controller' => 'Plans', 'action' => 'top']) ?>" class="btn waves-effect waves-light">ホームに戻る</a>
  </div>
</div>
