<?php $this->assign('title', '設定'); ?>

<script>
$(function() {


    $('#is_mail').change(function(){

    	if ($(this).is(':checked')) {

        $.ajax(
        {
          type: "POST",
          url: "https://adjusty.me/users/setting",
          data:
          {
            "is_mail" : 0
          },
          dataType: "text",
          success : function(response){
              alert('メール通知をオンにしました');
          },
          error: function(){
              alert('エラーが発生しました');
          }

       });

    	} else {

        $.ajax(
        {
          type: "POST",
          url: "https://adjusty.me/users/setting",
          data:
          {
            "is_mail" : 1
          },
          dataType: "text",
          success : function(response){
              alert('メール通知をオフにしました。予定作成時、確定時のメールが受信できなくなります。');
          },
          error: function(){
              alert('エラーが発生しました');
          }

       });

    	}
    });


  });
</script>

<div class="settingBox">
  <div class="settingtable">
    <table class="bordered">
      <tbody>
        <tr>
          <td><i class="small material-icons">email</i></td>
          <td><a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'email_edit']); ?>">メールアドレス変更<i class="small right material-icons">keyboard_arrow_right</i></a>
          </td>
        </tr>
        <tr>
          <td><i class="small material-icons">vpn_key</i></td>
          <td><a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'password_edit']); ?>">パスワード変更<i class="small right material-icons">keyboard_arrow_right</i></a>
          </td>
        </tr>
        <tr>
          <td><i class="small material-icons">notifications</i></td>
          <td>
            メール通知設定
          <div class="switch right">

            <label>
              <input type="checkbox" id="is_mail"
              <?php if ($user['is_mail'] == 0){
                echo 'checked="checked"';
              }?>
                >
              Off
              <span class="lever"></span>
              On
            </label>
          </div>
        </td>
        </tr>
        <tr>
          <td><i class="small material-icons">event</i></td>
          <td><a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'calSync']); ?>">カレンダー連携設定<i class="small right material-icons">keyboard_arrow_right</i></a>
          </td>
        </tr>
        <tr>
          <td><i class="small material-icons">delete_forever</i></td>
          <td><a href="<?php echo $this->Url->build(['controller' => 'Users', 'action' => 'delete']); ?>">退会<i class="small right material-icons">keyboard_arrow_right</i></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
