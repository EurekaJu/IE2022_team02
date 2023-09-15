<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="register-area ptb-100">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-12 col-lg-6 col-xl-6 ms-auto me-auto">
        <div class="login">
          <div class="login-form-container">
            <div class="users form content">
              <legend><?= __('Reset Password') ?></legend>
              <?= $this->Form->create(null, array('type' => 'post')); ?>
                  <input type="password" id="newpassword" name="newpassword"></input>
                  <div class="button-box">
                    <button type="submit" class="default-btn floatright">Reset</button>
                  </div>
                  <?= $this->Form->end(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>