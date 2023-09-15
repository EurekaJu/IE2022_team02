<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
use Cake\Utility\Security;

$this->Form->setTemplates([
    'error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);

$options = [
    'absolute' => 'absolute',
    'customer' => 'customer',
    'editor' => 'editor',
    'admin' => 'admin'];

?>

<div class="row">
    <aside class="column">
        <div class='container'>
            <h1 style="text-align:center">Edit User</h1>
        </div>
        <br>
        <div class='container'style="width:90%; margin:0 auto;display: flex;justify-content: center;">
        <div class="button-box">
            <?php
            $session = $this->request->getSession();
            $userRole = $session->read('userRole');
            if ($userRole == 'absolute'){
            ?>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id], ['class' => "default-btn floatright"],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]
            ) ?>
            <?= $this->Html->link('Users List', ['action' => 'index'], ['class' => "default-btn floatright"]) ?>
            <?php
            }
            else{
                ?>
                <?= $this->Html->link('Users List', ['action' => 'index'], ['class' => "default-btn floatright"]) ?>
                <?php
            }
            ?>
        </div>
        </div>
    </aside>
    <div class="register-area ptb-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12 col-lg-12 col-xl-6 ms-auto me-auto">
                    <div class="login-form-container">
                        <?= $this->Form->create($user) ?>
                        <fieldset>
                            <legend><?= __('Edit User') ?></legend>
                            <?php
                            echo $this->Form->control('email');
                            echo $this->Form->control('password', ['type' => 'hidden']);
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
                            ?>  <?php
                            $session2 = $this->request->getSession();
                            $role = $session2->read('userRole');
                            if ($role == 'absolute') {
                                echo "role";
                                echo $this->Form->select('role', $options, ['empty' => true]);
                                echo $this->Form->control('token', ['type' => 'hidden', 'value' => Security::hash(Security::randomBytes(256))]);
                            }
                            else {
                            echo $this->Form->control('token', ['type' => 'hidden', 'value' => Security::hash(Security::randomBytes(256))]);
                            }
                            ?>
                        </fieldset>
                        <div class="button-box">
                            <button type="submit" class="default-btn floatright">Submit</button>
                        </div>
                        <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
