<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Interest $interest
 * @var \Cake\Collection\CollectionInterface|string[] $books
 */
$date = date("yy-m-d");
// debug($this->Form->getTemplates());
$this->Form->setTemplates([
    'error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>

<head>
   <title> Margalya Press -  Register your interest for the TIQQUNEI HA-ZOHAR </title>
   <meta name="description" content="Register your interest for the first publication the TIQQUNEI HA-ZOHAR which will come in seven volumes and different formats. The registration of interest numbers will be used to manufacture the books.">
</head>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12 col-xl-6 ms-auto me-auto">
            <div class="login">
                <div class="login-form-container">
                    <div class="login-form">
                    <?= $this->Form->create($interest) ?>
                    <fieldset>
                        <legend><?= __('Register your interest') ?></legend>
                        <p>Register for the TIQQUNEI HA-ZOHAR book below.</p>
                        <?php
                            echo $this->Form->control('date', ['type' => 'hidden', 'value' => $date,'allowEmpty' => false]);
                            echo $this->Form->control('email', ['label'=>'Email Address *','allowEmpty' => false]);
                            echo $this->Form->control('first_name', ['label'=>'First name *','id' => 'first_name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                            echo $this->Form->control('last_name', ['label'=>'Last name *','id' => 'last_name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                            echo $this->Form->control('address', ['label'=>'Street Address *','allowEmpty' => false]);
                            echo $this->Form->control('city', ['label'=>'City *','id' => 'city' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                            echo $this->Form->control('state', ['label'=>'State/Province *','id' => 'state' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                            echo $this->Form->control('postcode', ['label'=>'Postcode/Zipcode *','allowEmpty' => false]);
                            echo "Country";
                            echo $this->Form->select('country', $countries);
                            if(isset($bookstatus)) {
                            echo $this->Form->control('book_id', ['options' => $booksInterest, 'label'=>'Book of interest *', 'empty' => true, 'value' => $bookId]);
                            }
                        ?>
                        <script>
                            var input = document.getElementById('first_name');
                            var input2 = document.getElementById('last_name');
                            var input3 = document.getElementById('city');
                            var input4 = document.getElementById('state');
                            input.oninvalid = function(event) {
                                event.target.setCustomValidity('Please Enter Text Only');
                            }
                            input2.oninvalid = function(event) {
                                event.target.setCustomValidity('Please Enter Text Only');
                            }
                            input3.oninvalid = function(event) {
                                event.target.setCustomValidity('Please Enter Text Only');
                            }
                            input4.oninvalid = function(event) {
                                event.target.setCustomValidity('Please Enter Text Only');
                            }
                        </script>
                    </fieldset>
                    <?php 
                    if(isset($bookstatus)) {
                    if($bookstatus == 'interest') { ?>
                        <div class="button-box">
                        <button type="submit" class="default-btn floatright">Submit</button>
                        </div>
                    <?php }
                    }
                    else { ?>
                        <br>
                        <h4> The TIQQUNEI HA-ZOHAR book is no longer taking registrations of interest. Please return to the home or book page to see the books. </h4>
                    <?php }
                    ?>
                    <!-- <div class="button-box">
                        <button type="submit" class="default-btn floatright">Submit</button>
                    </div> -->
                    <!-- <?= $this->Form->button(__('Submit')) ?> -->
                    <?= $this->Form->end() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
