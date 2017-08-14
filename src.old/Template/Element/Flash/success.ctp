<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="message success" onclick="this.classList.add('hidden')">
  <?= $message ?>
  <i class="close material-icons right">close</i>
</div>
