<div class="notice-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-6 col-xl-6 ms-auto me-auto">
                <div class="cancel">
                    <div class="login-form-container">
                        <div class="Cancel notice">
                            <h3>Payment Canceled</h3>
                            <br>
                            <fieldset>
                                <p>Forgot to add something to your cart? Shop around then come back to pay!</p>
                            </fieldset>
                            <br>
                            <div class="button-box">
                                <?= $this->Html->link(__('My Cart'), ['controller'=>'books', 'action' => 'cart'], ['class' => ['class' => "default-btn floatright"]]) ?>
                                <?= $this->Html->link("Home Page", ['controller' => 'books', 'action' => 'home'], ['class' => 'default-btn floatright']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
