<?php
$this->assign('title', 'メイン画像の編集');
?>
<?= $this->Html->css('cropbox_main') ?>

<div class="mypageBox">
  <div class="imageBox">
      <div class="thumbBox"></div>
      <div class="spinner" style="display: none">Loading...</div>
  </div>
  <div class="action">
      <form action="#">
      <div class="file-field input-field">
        <div class="btn">
          <span>File</span>
          <input id="file" type="file">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text">
        </div>
      </div>
      <p class="center-align">
        <input type="button" id="btnZoomOut" value="縮小" class="btn upload-btn">
        <input type="button" id="btnZoomIn" value="拡大" class="btn upload-btn">
        <input type="button" id="btnCrop" value="決定" class="btn upload-btn">
      </p>
    </form>
  </div>

  <div class="cropped">

  </div>
</div>
<script type="text/javascript">
    window.onload = function() {
        var options =
        {
            imageBox: '.imageBox',
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: 'avatar'
        }
        var cropper;
        document.querySelector('#file').addEventListener('change', function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = new cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            this.files = [];
        })
        document.querySelector('#btnCrop').addEventListener('click', function(){
            var img = cropper.getDataURL()
            // document.querySelector('.cropped').innerHTML += '<img src="'+img+'">';
            // alert(img);

            $.ajax(
                {
                  type: "POST",
                  url: "https://adjusty.me/users/mainImgEdet",
                  data:
                  {
                    "img" : img
                  },
                  dataType: "text",
                  success : function(response){
                      // alert('メール通知をオンにしました');
                      window.location.href = 'https://adjusty.me/users/mypage';
                  },
                  error: function(){
                      // alert('エラーが発生しました');
                  }
              });



        })
        document.querySelector('#btnZoomIn').addEventListener('click', function(){
            cropper.zoomIn();
        })
        document.querySelector('#btnZoomOut').addEventListener('click', function(){
            cropper.zoomOut();
        })
    };
</script>
