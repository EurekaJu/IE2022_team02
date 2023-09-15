<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
use Cake\Utility\Security;

$options = [
    'absolute' => 'absolute',
    'customer' => 'customer',
    'editor' => 'editor',
    'admin' => 'admin'];
$this->Form->setTemplates(['error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>

<div class="register-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-12 col-xl-6 ms-auto me-auto">
            <div class="button-box">
                <?php
                echo $this->Html->image("/webroot/img/previous.png", [
                "alt" => "back",
                'url' => ['controller' => 'Users', 'action' => 'index']
                ]);
                ?>
                <!--
                <?/*= $this->Html->link(__('Admin portal'), ['action' => 'index', 'controller' => 'Users'], ['class' => "default-btn floatright"]) */?>
                -->
    </div><br>
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form">
                            <?= $this->Form->create($user) ?>
                            <fieldset>
                                <legend><?= __('Add user') ?></legend>
                                <?php
                                echo $this->Form->control('email');
                                echo $this->Form->control('password');
                                echo $this->Form->control('first_name');
                                echo $this->Form->control('last_name');
                                echo $this->Form->control('mobile_number',['placeholder'=>'Please also include area code']);
                                echo $this->Form->control('street_number');
                                echo $this->Form->control('street_name');
                                echo $this->Form->control('suburb');
                                echo $this->Form->control('city');
                                echo $this->Form->control('postcode', ['label' => 'Postcode/Zipcode']);
                                echo $this->Form->control('state', ['label' => 'State/Province']);
                                echo "Country";
                                echo $this->Form->select('country', $countries);
                                ?> <?php echo "role" ?> <?php
                                echo $this->Form->select('role', $options, ['empty' => true]);
                                echo $this->Form->control('token', ['type'=>'hidden', 'value'=> Security::hash(Security::randomBytes(256))]);
                                ?>
                            </fieldset>
                            <div class="button-box">
                                <button type="submit" class="default-btn floatright">Sign Up</button>
                            </div>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
