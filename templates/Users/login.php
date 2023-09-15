
<head>
  <title> Login (Margalya Press) </title>
  <meta name="description" content="Login and access your account here. View your user details and order history. ">

</head>

<div class="register-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-6 col-xl-6 ms-auto me-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="users form">
                            <?= $this->Flash->render() ?>
                            <h3>Login</h3>
                            <?= $this->Form->create() ?>
                            <fieldset>
                                <!--<legend><?/*= __('Please enter your username and password') */?></legend>-->
                                <?= $this->Form->control('email', ['required' => true]) ?>
                                <?= $this->Form->control('password', ['required' => true]) ?>
                            </fieldset>
                            <div class="button-box">
                                <!--<input type="checkbox">
                                <label>Remember me</label>
                                <a href="#">Forgot Password?</a>-->
                                <button type="submit" class="default-btn floatright">Login</button>

                                <?= $this->Html->link(__('Sign Up'), ['controller'=>'Users', 'action' => 'add'], ['class' => ['class' => "default-btn "]]) ?>

                                <button class="default-btn" style="position: relative" "><?= $this->Html->link("Forgot password",['controller' => 'Users', 'action' => 'forgotpassword']) ?></button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
