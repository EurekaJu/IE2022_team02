<div class="notice-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-6 col-xl-6 ms-auto me-auto">
                <div class="success">
                    <div class="login-form-container">
                        <div class="Success notice">
                            <h3>Thanks for your order!</h3>
                            <br>
                            <fieldset>
                                <p>Thank you for shopping with us! If you had any questions, please contact us through the contact form in our website.</p>
                            </fieldset>
                            <br>
                            <div class="button-box">
                                <?php
                                $session = $this->request->getSession();
                                $userId = $session->read('userId');
                                ?>
                                <?= $this->Html->link(__('View My Orders'), ['controller'=>'Users', 'action' => 'view', $userId], ['class' => ['class' => "default-btn floatright"]]) ?>
                                <?= $this->Html->link("Home Page", ['controller' => 'books', 'action' => 'home'], ['class' => 'default-btn floatright']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
