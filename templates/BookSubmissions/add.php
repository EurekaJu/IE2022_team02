<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BookSubmission $bookSubmission
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
$this->Form->setTemplates([
    'error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);

$role = [ "Author" => "Author", "Translator" => "Translator"];
$complete = [ "Yes" => "Yes", "No" => "No"];
?>
<head>
  <title> Publisher Book Submissions form - Submit your text </title>
  <meta name="description" content="Submit a books that you wish to be published by us here, on Margalya Press. We always welcome you to communicate with us about Jewish texts and more.">
</head>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12 col-xl-6 ms-auto me-auto">
            <div class="login">
                <div class="login-form-container">
                    <div class="login-form">
                        <?= $this->Form->create($bookSubmission) ?>
                        <fieldset>
                            <legend><?= __('Book Submissions') ?></legend>
                            <p>Margalya Press is open to receiving book submissions that meet the following criteria. They must be: </p>
                            <ol>
                                <li>1. Jewish non-fiction texts</li>
                                <li>2. Complete, and have</li>
                                <li>3. Commercial potential.</li>
                            </ol>
                            <p>If your submission fors not meet these guidelines, we will be unable to consider it.</p>
                            <p>It may take several months for your submission to be considered. We will email you once it has been considered.
                                Please also be aware that we may not be able to provide editorial advice regarding your submission.</p>
                            <p>If you have a text that you believe will interest Margalya Press, please fill in the form below:</p>
                            <br>
                            <?php
                                echo $this->Form->control('user_id', ['type' => 'hidden', 'options' => $users, 'empty' => true]);
                                echo $this->Form->control('full_name', ['label'=>'Full name *','id' => 'full_name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                                echo $this->Form->control('email', ['label'=>'Email Address *','allowEmpty' => false]);
                                // echo $this->Form->control('time_sent', ['type'=>'hidden']);
                                echo $this->Form->control('title', ['label'=>'What is the title of your book? *','allowEmpty' => false]);
                                echo $this->Form->control('role', ['options' => $role, 'label'=>'Are you the author or translator? *','allowEmpty' => false]);
                                echo $this->Form->control('language', ['label'=>'What language is it in? *','allowEmpty' => false,'id' => 'language' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                                echo $this->Form->control('complete', ['options' => $complete, 'label'=>'Is it complete? *','allowEmpty' => false]);
                                echo $this->Form->control('description', ['label'=>'Tell us more about the book *','allowEmpty' => false,'row'=> 100,'cols'=>100]);
                                echo $this->Form->control('explanation', ['label'=>"Explain to us more about the book's market and commercial possibilities. *",'allowEmpty' => false,'row'=> 100,'cols'=>100]);
                            ?>

                            <script>
                                var input = document.getElementById('full_name');
                                var input2 = document.getElementById('language');
                                input.oninvalid = function(event) {
                                    event.target.setCustomValidity('Please Enter Text Only');
                                }
                                input2.oninvalid = function(event) {
                                    event.target.setCustomValidity('Please Enter Text Only');
                                }

                            </script>
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
