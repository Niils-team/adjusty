<?php
$this->assign('title', '画像の編集');
?>
<?= $this->Html->css('cropbox') ?>

<div class="mypageBox">
  <div class="imageBox">
      <div class="thumbBox" id="data"></div>
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
        <input id="btnZoomOut" value="縮小" class="btn upload-btn" type="button">
        <input id="btnZoomIn" value="拡大" class="btn upload-btn" type="button">
        <input id="btnCrop" value="決定" class="btn upload-btn" type="button">
      </p>
    </form>
  </div>

</div>
<script type="text/javascript">
    window.onload = function() {
        var options =
        {
            imageBox: '.imageBox',
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: 'avatar.png'
        }
        var cropper;
        document.querySelector('#file').addEventListener('change', function(){
            var reader = new FileReader();

            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = new cropbox(options);
            }

            var file = this.files[0];

            if(!/image/.test(file.type)) {
              alert('画像を選択してください。');
              return;
            }

            EXIF.getData(file, function(){
                var orientation = file.exifdata.Orientation;
                var mpImg = new MegaPixImage(file);
                // mpImg.render($("#file")[0], { orientation: orientation });
            });

            // var exif = new Exif( file );
            reader.readAsDataURL(this.files[0]);
            // reader.readAsDataURL($("#file")[0], { orientation: orientation });
            this.files = [];


        })


        document.querySelector('#btnCrop').addEventListener('click', function(){
            var img = cropper.getDataURL()
            // document.querySelector('.cropped').innerHTML += '<img src="'+img+'">';
            // alert(img);

            $.ajax(
                {
                  type: "POST",
                  url: "https://adjusty.me/users/coverImgEdet",
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
