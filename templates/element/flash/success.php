<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<style>
.success {
  padding: 20px;
  background-color: #228B22;
  color: white;
  animation: hideAnimation 3s forwards;
}
@keyframes hideAnimation {
    0%{
        opacity: 1;
    }
    99.99%{
        opacity: 1;
    }
    100%{
        opacity: 0;
    }
}
</style>

<div class="success" onclick="this.classList.add('hidden');"><?= $message ?></div>
<!-- <div class="message success" onclick="this.classList.add('hidden')"><?= $message ?></div> -->
