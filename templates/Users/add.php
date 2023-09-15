<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
use Cake\Utility\Security;
$this->Form->setTemplates(['error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>
<script src='https://www.google.com/recaptcha/api.js'></script>


<head>
  <title> Sign up and subscribe to Margalya Press </title>
  <meta name="description" content="Sign up with Margalya Press to create an account and receive promotional emails from Margalya Press. Sign up for Interact more with us">
</head>

<div class="register-area ptb-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-12 col-xl-6 ms-auto me-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form" id="my_captcha_form">
                            <?= $this->Form->create($user) ?>
                            <fieldset>
                                <legend><?= __('Sign Up') ?></legend>
                                <?php
                                echo $this->Form->control('email');
                                echo $this->Form->control('password');
                                echo $this->Form->control('first_name', ['id' => 'first_name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                                echo $this->Form->control('last_name', ['id' => 'last_name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                                echo $this->Form->control('mobile_number',['placeholder'=>'Please also include your area code']);
                                echo $this->Form->control('street_number');
                                echo $this->Form->control('street_name');
                                echo $this->Form->control('suburb', ['id' => 'suburb' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                                echo $this->Form->control('city', ['id' => 'city' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                                echo $this->Form->control('postcode', ['label' => 'Postcode/Zipcode']);
                                echo $this->Form->control('state', ['label' => 'State/Province', 'id' => 'state' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                                echo "Country";
                                echo $this->Form->select('country', $countries);
                                echo $this->Form->control('role',['type'=>'hidden', 'value'=> 'customer']);
                                echo $this->Form->control('token', ['type'=>'hidden', 'value'=> Security::hash(Security::randomBytes(256))]);
                                ?><br><br><?php
                                echo "<div class='g-recaptcha' data-sitekey='" . $recaptcha_user . "'></div>";
                                ?>
                                <script>
                                    var input = document.getElementById('first_name');
                                    var input2 = document.getElementById('last_name');
                                    var input3 = document.getElementById('suburb');
                                    var input4 = document.getElementById('city');
                                    var input5 = document.getElementById('state');
                                    input.oninvalid = function(event) {
                                        event.target.setCustomValidity('Please Enter Text Only');
                                    }
                                    input2.oninvalid = function (event){
                                        event.target.setCustomValidity('Please Enter Text only');
                                    }
                                    input3.oninvalid = function (event){
                                        event.target.setCustomValidity('Please Enter Text only');
                                    }
                                    input4.oninvalid = function (event){
                                        event.target.setCustomValidity('Please Enter Text only');
                                    }
                                    input5.oninvalid = function (event){
                                        event.target.setCustomValidity('Please Enter Text only');
                                    }

                                </script>
                            </fieldset>

                            <div class="button-box">
                                <button type="submit" class="default-btn floatright">Sign Up</button>
                            </div>
                            <script>
                                document.getElementById("my_captcha_form").addEventListener("submit",function(evt)
                                {

                                    var response = grecaptcha.getResponse();
                                    if(response.length == 0)
                                    {
                                        //reCaptcha not verified
                                        alert("Please Check the Recaptcha Box!");
                                        evt.preventDefault();
                                        return false;
                                    }
                                    //captcha verified
                                    //do the rest of your validations here

                                });

                            </script>
                            <?= $this->Form->end() ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
