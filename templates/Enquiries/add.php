<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Enquiry $enquiry
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */


$options = [
    'Publishers' => 'Publishers',
    'General' => 'General'];
    $this->Form->setTemplates(['error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>

<head>
  <title> Margalya Press -  Contact us </title>
  <meta name="description" content="Contact Margalya Press for any enquiries and questions. We are always happy to hear from you for any suggestions or requirements.">
</head>

<div class="register-area ptb-10">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 col-12 col-lg-12 col-xl-6 ms-auto me-auto">
                <div class="login">
                    <div class="login-form-container">
                        <div class="login-form">
            <?= $this->Form->create($enquiry) ?>
            <fieldset>
                <legend><?= __('Contact us') ?></legend>
                <?php
                    echo $this->Form->control('full_name',['id' => 'fullname' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$', 'title'=> 'Text Only' ,'label'=>'Full name * ','allowEmpty' => false]);

                    echo $this->Form->control('body', ['label'=>'Body * ','row'=> 100,'cols'=>100]);
                    echo $this->Form->control('email', ['label'=>'Your Email Address *']);
                    echo $this->Form->control('resolved', ['type' => 'hidden', 'value' => 0]); //set resolved to =0
                    ?> <?php echo 'Type' ?> <?php
                    echo $this->Form->select('type', $options, ['empty' => true, 'typeholder' => 'Type']);
                    //echo $this->Form->control('time_sent');
                    echo $this->Form->control('user_id', ['type' => 'hidden','options' => $users, 'empty' => true]);
                ?>

                <script>
                    var input = document.getElementById('fullname');
                    input.oninvalid = function(event) {
                        event.target.setCustomValidity('Please Enter Text Only');
                    }
                </script>

            </fieldset>
            <div class="button-box">
                 <button type="submit" class="default-btn floatright">SEND</button>
            </div>
        </div>
    </div>
</div>
<div>
</div>
</div>
</div>
</div>

