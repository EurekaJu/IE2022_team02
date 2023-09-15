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
.alert {
  padding: 20px;
  background-color: #f44336;
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

<div class="alert" onclick="this.classList.add('hidden');"><?= $message ?></div>
<!-- <div class="message error" onclick="this.classList.add('hidden');"><?= $message ?></div> -->
