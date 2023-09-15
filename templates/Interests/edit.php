<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Interest $interest
 * @var string[]|\Cake\Collection\CollectionInterface $books
 */
$this->Form->setTemplates([
    'error' => '<div style="color:red; font-size: 80%; margin-top: -15px; margin-bottom: 20px" class="error-message" id="{{id}}">{{content}} </div> ',
]);
?>
<div class="row">
<div class="container">
<div class="button-box">
        <br>
        <?php echo $this->Html->image("/webroot/img/previous.png", [
            "alt" => "back",
            'url' => ['controller' => 'Interests', 'action' => 'index']
        ]); ?>
        
    <aside class="column">
        <div class="side-nav"><br>
            <div class="button-box">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $interest->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $interest->id), 'class' => 'default-btn floatright']
            ) ?>
            <?= $this->Html->link(__('List Interests'), ['action' => 'index'], ['class' => 'default-btn floatright']) ?>
            </div>
            </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="interests form content">
        <div class="table-content table-responsive">
            <?= $this->Form->create($interest) ?>
            <fieldset>
                <br><legend><?= __('Edit Interest') ?></legend>
                <?php
                    echo $this->Form->control('date');
                    echo $this->Form->control('email');
                    echo $this->Form->control('first_name',['label'=>'First name *','id' => 'first_name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('last_name', ['label'=>'Last name *','id' => 'last_name' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('address');
                    echo $this->Form->control('city', ['label'=>'City *','id' => 'city' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('state', ['label'=>'State/Province *','id' => 'state' , 'type'=>'text', 'minlength' =>'0','pattern' => '^[a-zA-Z]+(\s[a-zA-Z]+)?$','allowEmpty' => false]);
                    echo $this->Form->control('postcode', ['label'=>'Postcode/Zipcode *','allowEmpty' => false]);
                    echo "Country";
                    echo $this->Form->select('country', $countries);
                    echo $this->Form->control('book_id', ['options' => $books, 'empty' => true]);
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
            <div class="button-box">
                <button type="submit" class="default-btn floatright">Submit</button>
            </div>
            <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
</div>
