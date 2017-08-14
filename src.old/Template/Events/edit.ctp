<!-- <div class="blue-grey darken-2 valign-wrapper adjusty-sub-nav">
  <ul class="tabs blue-grey darken-2">
    <li class="tab col s6"><a class="active" href="#">直近の予定</a></li>
    <li class="tab col s6"><a href="#">調整中の予定</a></li>
  </ul>
</div> -->

<div class="section-start">
  <ul class="collection collapsible" data-collapsible="accordion">
    <?php
    foreach ($plans as $plan):
    ?>
    <li>
      <div class="collapsible-header collection-item avatar">
        <!-- <?php echo $this->Html->image('hiroshi1.jpg', ['class' => 'circle']); ?> -->
        <span class="title"><?php echo $plan['title']; ?></span>
          <p>プラン作成日：</p>
        <!-- <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a> -->
      </div>
      <div class="collapsible-body">
        <p>
          住所：東京都杉並区高円寺南1-7-4 杉木ビル2F<br>
          電話：03-1234-5678<br>
          目的：営業<br>
        </p>
      </div>
    </li>
    <?php endforeach; ?>
  </ul>
</div>

<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a href="<?php echo $this->Url->build(['controller'=>'Pages', 'action'=>'eventcreate']); ?>" class="btn-floating btn-large waves-effect waves-light red">
    <i class="material-icons">add</i>
  </a>
</div>
